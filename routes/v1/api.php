<?php

use App\Http\Controllers\V1\CustomerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/customers')->group(function () {
        Route::get('/list', [CustomerController::class, 'index']);
        Route::post('/create', [CustomerController::class, 'store']);
        Route::get('/{id}/show', [CustomerController::class, 'show']);
        Route::put('/{id}/update', [CustomerController::class, 'update']);
        Route::delete('/{id}/delete', [CustomerController::class, 'destroy']);
    });
    Route::prefix('/services')->group(function () {
        //
    });
});
