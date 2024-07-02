<?php

use App\Http\Controllers\ApiController\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('index/{id?}', [UserController::class, 'index'])->name('index');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::put('update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
});
