<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Requests\UpdateBorrowingRequest;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->get();
        return response()->json($borrowings);
    }

    public function store(StoreBorrowingRequest $request)
    {
        $validated = $request->validated();

        $borrowing = Borrowing::create([
            'user_id'     => $validated['user_id'],
            'book_id'     => $validated['book_id'],
            'borrow_date' => $validated['borrow_date'] ?? now(),
            'return_date' => $validated['return_date'] ?? null,
            'status'      => $validated['status'] ?? 'borrowed',
        ]);

        return response()->json($borrowing->load(['user', 'book']), 201); // ✅ 201 created
    }

    public function show($id)
    {
        $borrowing = Borrowing::with(['user', 'book'])->find($id);

        if (!$borrowing) {
            return response()->json(['message' => 'Borrowing not found'], 404);
        }

        return response()->json($borrowing);
    }

    public function update(UpdateBorrowingRequest $request, $id)
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            return response()->json(['message' => 'Borrowing not found'], 404);
        }

        $borrowing->update($request->validated());

        return response()->json($borrowing->load(['user', 'book']));
    }

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
