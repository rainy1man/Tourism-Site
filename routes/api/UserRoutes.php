<?php

use App\Http\Controllers\ApiController\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('{id}', [UserController::class, 'show'])->name('show');
    Route::put('{id}', [UserController::class, 'update'])->name('update');
    Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::post('profile', [UserController::class, 'profile'])->name('profile');
Route::post('update_profile', [UserController::class, 'update_profile'])->name('update.profile');
