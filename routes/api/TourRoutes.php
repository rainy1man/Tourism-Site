<?php

use App\Http\Controllers\ApiController\TourController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tour', 'as' => 'tour.'], function () {
    Route::get('/', [TourController::class, 'index'])->name('index')->withoutMiddleware('auth:sanctum');
    Route::post('/', [TourController::class, 'store'])->name('store');
    Route::get('{id}', [TourController::class, 'show'])->name('show')->withoutMiddleware('auth:sanctum');
    Route::put('{id}', [TourController::class, 'update'])->name('update');
    Route::delete('{id}', [TourController::class, 'destroy'])->name('destroy');
});
