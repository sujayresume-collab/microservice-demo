<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'verify']);
    Route::post('/verify', [AuthController::class, 'verify']);
});

Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'service' => 'user-service']);
});
