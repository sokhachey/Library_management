<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Display a listing of borrowings with related user and book.
     */
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->get();
        return response()->json($borrowings);
    }

    /**
     * Store a new borrowing record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'status' => 'nullable|string|in:borrowed,returned,late'
        ]);

        $borrowing = Borrowing::create([
            'user_id'     => $validated['user_id'],
            'book_id'     => $validated['book_id'],
            'borrow_date' => $validated['borrow_date'] ?? now(),
            'return_date' => $validated['return_date'] ?? null,
            'status'      => $validated['status'] ?? 'borrowed',
        ]);

        return response()->json($borrowing->load(['user', 'book']), 201);
    }

    /**
     * Display a specific borrowing.
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            return response()->json(['message' => 'Borrowing not found'], 404);
        }

        $validated = $request->validate([
            'user_id'     => 'sometimes|exists:users,id',
            'book_id'     => 'sometimes|exists:books,id',
            'borrow_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'status'      => 'nullable|string|in:borrowed,returned,late'
        ]);

        $borrowing->update($validated);

        return response()->json($borrowing->load(['user', 'book']));
    }

    /**
     * Delete a specific borrowing.
     */
    public function destroy($id)
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            return response()->json(['message' => 'Borrowing not found'], 404);
        }

        $borrowing->delete();

        return response()->json(['message' => 'Borrowing deleted successfully']);
    }
}
