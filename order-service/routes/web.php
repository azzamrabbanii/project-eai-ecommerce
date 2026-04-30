<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/history/{user_id}', [OrderController::class, 'history']);
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
});