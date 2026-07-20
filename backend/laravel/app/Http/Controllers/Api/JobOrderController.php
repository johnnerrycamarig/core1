<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class JobOrderController extends Controller
{
    public function index()
    {
        return response()->json([
            ['id' => 1, 'order_id' => 'JO-001', 'client' => 'Juan Dela Cruz', 'service' => 'Printing', 'status' => 'Ongoing'],
            ['id' => 2, 'order_id' => 'JO-002', 'client' => 'Maria Santos', 'service' => 'Rental', 'status' => 'Completed'],
        ]);
    }
}
