<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Assuming API authentication is configured (e.g., Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users', [UserController::class, 'update']);

    // Example role-based routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return response()->json(['message' => 'Welcome Admin']);
        });
    });

    Route::middleware('role:seller')->group(function () {
        Route::get('/seller/dashboard', function () {
            return response()->json(['message' => 'Welcome Seller']);
        });
    });
});
