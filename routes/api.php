<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\reveiwController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('product', productsController::class);
Route::apiResource('reviews' , reveiwController::class);
Route::apiResource('auth' , AuthController::class);