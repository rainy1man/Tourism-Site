<?php


use App\Http\Controllers\ApiController\SettingController;
use Illuminate\Support\Facades\Route;



Route::get('/settings/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit');
Route::post('/settings/{id}', [SettingController::class, 'update'])->name('settings.update');
Route::post('/settings/reset-defaults', [SettingController::class, 'resetDefaults'])->name('settings.resetDefaults');
