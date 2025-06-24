<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     */
    public function index(): JsonResponse
    {
        $suppliers = Supplier::all();

        return response()->json([
            'message' => 'Suppliers retrieved successfully',
            'data' => $suppliers
        ]);
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(StoreSupplierRequest $request): JsonResponse
    {
        // Get validated data
        $validated = $request->validated();

        // Create supplier
        $supplier = Supplier::create($validated);

        return response()->json([
            'message' => 'Supplier created successfully',
            'data' => $supplier
        ], 201);
    }

    /**
     * Display the specified supplier.
     */
    public function show(string $id): JsonResponse
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        return response()->json([
            'message' => 'Supplier retrieved successfully',
            'data' => $supplier
        ]);
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(UpdateSupplierRequest $request, string $id): JsonResponse
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        // Get validated data
        $validated = $request->validated();

        // Update supplier
        $supplier->update($validated);

        return response()->json([
            'message' => 'Supplier updated successfully',
            'data' => $supplier
        ]);
    }

    /**
     * Remove the specified supplier from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted successfully'], 200);
    }
}