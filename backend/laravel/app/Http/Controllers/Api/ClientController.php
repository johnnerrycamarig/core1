<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json([
            ['id' => 1, 'name' => 'Juan Dela Cruz', 'contact' => '0912 345 6789', 'email' => 'juan.delacruz@email.com'],
            ['id' => 2, 'name' => 'Maria Santos', 'contact' => '0917 890 1234', 'email' => 'maria.santos@email.com'],
        ]);
    }
}
