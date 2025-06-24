<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index(): JsonResponse
    {
        $books = Book::with(['supplier', 'category'])->get();

        $booksWithNames = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'description' => $book->description,
                'supplier_id' => $book->supplier_id,
                'supplierName' => $book->supplier ? $book->supplier->name : 'N/A',
                'category_id' => $book->category_id,
                'categoryName' => $book->category ? $book->category->name : 'N/A',
                'created_at' => $book->created_at,
                'updated_at' => $book->updated_at,
            ];
        });

        return response()->json([
            'message' => 'Books retrieved successfully',
            'data' => $booksWithNames
        ]);
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $book = Book::create($validated);

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified book.
     */
    public function show(string $id): JsonResponse
    {
        $book = Book::with(['supplier', 'category'])->find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $bookWithNames = [
            'id' => $book->id,
            'title' => $book->title,
            'description' => $book->description,
            'supplier_id' => $book->supplier_id,
            'supplierName' => $book->supplier ? $book->supplier->name : 'N/A',
            'category_id' => $book->category_id,
            'categoryName' => $book->category ? $book->category->name : 'N/A',
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at,
        ];

        return response()->json([
            'message' => 'Book retrieved successfully',
            'data' => $bookWithNames
        ]);
    }

    /**
     * Update the specified book in storage.
     */
    public function update(UpdateBookRequest $request, string $id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $validated = $request->validated();
        $book->update($validated);
        
        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $book
        ]);
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}