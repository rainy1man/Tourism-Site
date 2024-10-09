<?php

use App\Http\Controllers\ApiController\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/{id}', [OrderController::class, 'show'])->name('show');
    Route::post('/{trip}', [OrderController::class, 'store'])->name('store');
    Route::put('change_status/{id}', [OrderController::class, 'change_status'])->name('change_status');
    Route::get('monthly_sales/{date}/{id?}', [OrderController::class, 'monthly_sales'])->name('monthly_sales');
    Route::get('average_sales/{date}', [OrderController::class, 'average_sales'])->name('average_sales');
    Route::get('total_sales/{date}', [OrderController::class, 'total_sales'])->name('total_sales');
    Route::post('calculate_total_amount/{trip}', [OrderController::class, 'calculate_total_amount'])->name('calculate_total_amount');
});
