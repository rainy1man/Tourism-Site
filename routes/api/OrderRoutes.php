<?php

use App\Http\Controllers\ApiController\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('index/{id?}', [OrderController::class, 'index'])->name('index');
    Route::post('store', [OrderController::class, 'store'])->name('store');
    Route::put('update/{id}', [OrderController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [OrderController::class, 'destroy'])->name('destroy');
});
