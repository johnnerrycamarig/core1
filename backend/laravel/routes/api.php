<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\JobOrderController;
use App\Http\Controllers\Api\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/mfa/verify', [AuthController::class, 'verifyMfa']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('clients', [ClientController::class, 'index']);
    Route::get('job-orders', [JobOrderController::class, 'index']);
    Route::get('dashboard/metrics', [DashboardController::class, 'metrics']);
});
