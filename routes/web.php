<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\TransactionController;
Route::get('/', function () {
    return view('welcome');
});


Route::apiResource('users',controller: UserController::class);
Route::apiResource('merchants', MerchantController::class);
Route::apiResource('transactions', TransactionController::class);