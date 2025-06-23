<?php

use App\Http\Controllers\Api\V1\UserController;
use App\Models\User;
use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    
Route::prefix('v1')->group(function () {
    Route::apiResource('admins', AdminController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('report', ReportController::class);
    Route::apiResource('users', UserController::class);
});
