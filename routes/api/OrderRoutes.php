<?php

use App\Http\Controllers\ApiController\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('show/{id}', [OrderController::class, 'show'])->name('show');
    Route::post('store/{trip}', [OrderController::class, 'store'])->name('store');
    Route::put('change_status/{id}', [OrderController::class, 'change_status'])->name('change_status');
});
