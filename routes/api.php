<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\reveiwController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('product', productsController::class);
Route::apiResource('reviews' , reveiwController::class);
Route::apiResource('auth' , AuthController::class);
Route::apiResource('signUp' , SignUpController::class);
Route::prefix('dashboard')->group(function(){
    Route::get('all-reviews' , [reveiwController::class , 'allReviews']);
    Route::get('previews-months' , [reveiwController::class , 'getPreviusMonthReviews']);
    Route::get('report-of-current-user' , [userController::class , 'getcurrentMonthUser']);
    Route::get('report-of-previous-user' , [userController::class , 'getPreviouMonthUser']);
    Route::get('CurrentMonthlyProduct' , [productsController::class , 'CurrentMonthlyProduct']);
    Route::get('PrevMonthlyProduct' , [productsController::class , 'PrevMonthlyProduct']);
    Route::get('all-product' , [productsController::class , 'getAllProduct']);
    Route::post('store-product' , [productsController::class , 'store']);
    Route::apiResource('/all-users' , userController::class);
});