<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Bool_;

class BorrowingController extends Controller
{
    /**
     * Display a listing of borrowings.
     */
    public function index()
    {
        $borrowings =  Borrowing::with(['user', 'book'])->get();
        return response()->json($borrowings);
    }

    /**
     * Store a new borrowing record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'status' => 'nullable|string'
        ]);

        $borrowing = Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date ?? now(),
            'return_date' => $request->return_date,
            'status' => $request->status ?? 'borrowed',
        ]);

        return response()->json($borrowing, 201);
    }

    /**
     * Display a specific borrowing.
     */
    public function show(string $id)
    {
        $borrowing = Borrowing::with(['user', 'book'])->find($id);
        if (!$borrowing) {
            return response()->json(['message' => 'Borrowing not found'], 404);
        }
        return response()->json($borrowing);
    }

    /**
     * Update a specific borrowing.
     */
    public function update(Request $request, string $id)
    {
        $borrowing = Borrowing::find($id);
        if (!$borrowing) {
            return response()->json(['message' => 'Borrowing not found'], 404);
        }

        $borrowing->update($request->only([
            'user_id',
            'book_id',
            'borrow_date',
            'return_date',
            'status'
        ]));

        return response()->json($borrowing);
    }

    /**
     * Delete a specific borrowing.
     */
    public function destroy(string $id)
    {
        $borrowing = Borrowing::find($id);
        if (!$borrowing) {
            return response()->json(['message' => 'Borrowing not found'], 404);
        }

        $borrowing->delete();
        return response()->json(['message' => 'Borrowing deleted successfully'], 204);
    }
}
