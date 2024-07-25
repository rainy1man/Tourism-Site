<?php


use App\Http\Controllers\ApiController\SettingController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
Route::group(['prefix' => 'settings', 'as' => 'settings.'], function() {
    Route::get('index', [SettingController::class, 'index'])->name('index')->withoutMiddleware('auth:sanctum');
    Route::get('show/{id}', [SettingController::class, 'show'])->name('show')->withoutMiddleware('auth:sanctum');
    Route::put('update/{id}', [SettingController::class, 'update'])->name('update');
});
});
