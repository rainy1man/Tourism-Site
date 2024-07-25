<?php

use App\Http\Controllers\ApiController\TourController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tour', 'as' => 'tour.'], function () {
    Route::get('/', [TourController::class, 'index'])->name('index');
    Route::post('/', [TourController::class, 'store'])->name('store')->middleware('auth:sanctum');
    Route::get('{id}', [TourController::class, 'show'])->name('show');
    Route::put('{id}', [TourController::class, 'update'])->name('update')->middleware('auth:sanctum');
    Route::delete('{id}', [TourController::class, 'destroy'])->name('destroy')->middleware('auth:sanctum');
});
