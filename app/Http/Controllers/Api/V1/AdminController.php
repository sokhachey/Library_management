<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $admins = Admin::all();
        return response()->json([
            'message' => 'Admins retrieved successfully',
            'data' => $admins
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request): JsonResponse
    {
        // Get validated data
        $validated = $request->validated();

        // Create admin with hashed password
        $admin = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'message' => 'Admin created successfully',
            'data' => $admin
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }
        return response()->json([
            'message' => 'Admin retrieved successfully',
            'data' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $id): JsonResponse
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        // Get validated data
        $validated = $request->validated();

        // Prepare data for update
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        // Hash password if provided
        if (isset($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        // Update admin
        $admin->update($data);

        return response()->json([
            'message' => 'Admin updated successfully',
            'data' => $admin
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $admin->delete();
        return response()->json(['message' => 'Admin deleted successfully']);
    }
}