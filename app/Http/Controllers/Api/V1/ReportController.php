<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    /**
     * Display a listing of the reports.
     */
    public function index(): JsonResponse
    {
        $reports = Report::with('user:name,id')->get();
        return response()->json([
            'message' => 'Reports retrieved successfully',
            'data' => $reports
        ]);
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(StoreReportRequest $request): JsonResponse
    {
        // Get validated data
        $validated = $request->validated();

        // Create report
        $report = Report::create($validated);

        // Load user relationship
        $report->load('user:name,id');

        return response()->json([
            'message' => 'Report created successfully',
            'data' => $report
        ], 201);
    }

    /**
     * Display the specified report.
     */
    public function show(string $id): JsonResponse
    {
        $report = Report::with('user:name,id')->find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        return response()->json([
            'message' => 'Report retrieved successfully',
            'data' => $report
        ]);
    }

    /**
     * Update the specified report in storage.
     */
    public function update(UpdateReportRequest $request, string $id): JsonResponse
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        // Get validated data
        $validated = $request->validated();

        // Update report
        $report->update($validated);

        // Load user relationship
        $report->load('user:name,id');

        return response()->json([
            'message' => 'Report updated successfully',
            'data' => $report
        ]);
    }

    /**
     * Remove the specified report from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $report->delete();

        return response()->json([
            'message' => 'Report deleted successfully',
            'data' => []
        ], 200);
    }
}