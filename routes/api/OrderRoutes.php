<?php

use App\Http\Controllers\ApiController\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/{id}', [OrderController::class, 'show'])->name('show');
    Route::post('/{trip}', [OrderController::class, 'store'])->name('store');
    Route::put('change_status/{id}', [OrderController::class, 'change_status'])->name('change_status');
});
