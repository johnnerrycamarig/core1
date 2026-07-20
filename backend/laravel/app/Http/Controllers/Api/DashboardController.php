<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Return sample dashboard metrics.
     * In a real app this would query the database for counts and aggregates.
     */
    public function metrics(Request $request): JsonResponse
    {
        $data = [
            'clients' => 120,
            'active_jobs' => 35,
            'rentals' => 18,
            'projects' => 12,
        ];

        return response()->json($data);
    }
}
