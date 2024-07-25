<?php

use App\Http\Controllers\ApiController\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
});
