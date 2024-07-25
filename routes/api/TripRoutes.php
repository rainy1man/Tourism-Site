<?php

use App\Http\Controllers\ApiController\TripController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'trip', 'as' => 'trip.'], function () {
    Route::get('/', [TripController::class, 'index'])->name('index');
    Route::post('/', [TripController::class, 'store'])->name('store')->middleware('auth:sanctum');
    Route::get('{id}', [TripController::class, 'show'])->name('show');
    Route::put('{id}', [TripController::class, 'update'])->name('update')->middleware('auth:sanctum');
    Route::delete('{id}', [TripController::class, 'destroy'])->name('destroy')->middleware('auth:sanctum');
});
