<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', App\Http\Controllers\Api\CategoryVoucherController::class);
    Route::apiResource('vouchers', App\Http\Controllers\Api\VoucherController::class);

    Route::apiResource('voucher-claims', App\Http\Controllers\Api\VoucherClaimController::class);
    Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
});
