<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\VerifyUserServiceToken;

Route::middleware([VerifyUserServiceToken::class])->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'service' => 'product-service']);
});
