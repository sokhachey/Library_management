<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('user:name,id')->get();
        return response()->json(['data' => $reports]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'joined_date' => 'required|date',
            'exits_date' => 'nullable|date|after_or_equal:joined_date',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $report = Report::create([
            'user_id' => $request->user_id,
            'joined_date' => $request->joined_date,
            'exits_date' => $request->exits_date,
        ]);

        $report->load('user:name,id');
        return response()->json(['data' => $report], 201);
    }

    public function show(string $id)
    {
        $report = Report::with('user:name,id')->find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }
        return response()->json(['data' => $report]);
    }

    public function update(Request $request, string $id)
    {
        $report = Report::find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'joined_date' => 'required|date',
            'exits_date' => 'nullable|date|after_or_equal:joined_date',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $report->update([
            'user_id' => $request->user_id,
            'joined_date' => $request->joined_date,
            'exits_date' => $request->exits_date,
        ]);

        $report->load('user:name,id');
        return response()->json(['data' => $report]);
    }

    public function destroy(string $id)
    {
        $report = Report::find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $report->delete();
        return response()->json(['data' => ['message' => 'Report deleted successfully']]);
    }
}