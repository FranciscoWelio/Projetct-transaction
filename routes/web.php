<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::apiResource('users',controller: '\App\Http\Controllers\UserController::class');
Route::apiResource('merchant',controller: '\App\Http\Controllers\UserController::class');
Route::apiResource('transaction',controller: '\App\Http\Controllers\UserController::class');