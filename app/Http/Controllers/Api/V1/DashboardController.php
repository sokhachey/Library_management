<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $data = [
            'books' => Book::count(),
            'users' => User::count(),
            'borrowings' => Borrowing::count(),
            'reports' => Report::count(),
        ];

        return response()->json([
            'message' => 'Dashboard data retrieved successfully',
            'data' => $data
        ]);
    }
}
