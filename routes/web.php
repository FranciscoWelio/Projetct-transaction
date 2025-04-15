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

use Illuminate\Support\Facades\DB;

Route::get('/check-db', function() {
    try {
        DB::connection()->getPdo();
        return response()->json([
            'status' => 'success',
            'message' => 'Conectado ao SQLite: ' . DB::connection()->getDatabaseName()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erro na conexão: ' . $e->getMessage()
        ], 500);
    }
});