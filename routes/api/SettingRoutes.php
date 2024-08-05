<?php

use App\Http\Controllers\ApiController\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'setting', 'as' => 'setting.'], function() {
    Route::get('', [SettingController::class, 'index'])->name('index');
    Route::get('/{id}', [SettingController::class, 'show'])->name('show')->withoutMiddleware('auth:sanctum');
    Route::put('/{id}', [SettingController::class, 'update'])->name('update');
});
