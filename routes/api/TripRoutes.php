<?php

use App\Http\Controllers\ApiController\TripController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'trip', 'as' => 'trip.'], function () {
    Route::get('/', [TripController::class, 'index'])->name('index')->withoutMiddleware('auth:sanctum');
    Route::post('/', [TripController::class, 'store'])->name('store');
    Route::get('{id}', [TripController::class, 'show'])->name('show')->withoutMiddleware('auth:sanctum');
    Route::put('{id}', [TripController::class, 'update'])->name('update');
    Route::delete('{id}', [TripController::class, 'destroy'])->name('destroy');
});
