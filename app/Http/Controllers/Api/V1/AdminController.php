<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Admin::all();
        return response()->json($admin);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = new Admin();
        $admin->name =  $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->save();
        return response()->json($admin);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::find($id);
        if(!$admin){
            return response()->json(['message' => 'admin not found']);
        }
        return response()->json($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Admin::find($id);
        if(!$admin){
            return response()->json(['message' => 'update admin not found']);
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->save();
        return response()->json($admin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::find($id);
        if(!$admin){
            return response()->json(['message' => 'deleted not found']);
        }
        $admin->delete();
        return response()->json($admin);
    }
}
