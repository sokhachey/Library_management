<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $report = Report::all();
        return response()->json($report);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $report = new Report();
        $report->joined_date = $request->joined_date;
        $report->exits_date = $request->exits_date;
        $report->user_id = $request->user_id;
        $report->save();
        return response()->json($report);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = Report::find($id);
        if (!$report) {
            return response()->json(['message' => 'category not found']);
        }
        return response()->json($report);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $report = Report::find($id);
        if (!$report) {
            return response()->json(['message' => 'update has error']);
        }
        $report->joined_date = $request->joined_date;
        $report->exits_date = $request->exits_date;
        $report->user_id = $request->user_id;
        $report->save();
        return response()->json($report);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $report = Report::find($id);
        if(!$report){
            return response()->json(['message' => 'delete has error']);
        }
        $report->delete();
        return response()->json($report);
    }
}
