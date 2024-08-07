<?php

use App\Http\Controllers\ApiController\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'settings', 'as' => 'settings.'], function() {
    Route::get('index', [SettingController::class, 'index'])->name('index');
    Route::get('show/{id}', [SettingController::class, 'show'])->name('show')->withoutMiddleware('auth:sanctum');
    Route::post('update/{id}', [SettingController::class, 'update'])->name('update');
});
