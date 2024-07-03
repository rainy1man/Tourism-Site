<?php

use App\Http\Controllers\ApiController\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::get('index/{id?}', [CategoryController::class, 'index'])->name('index');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});
