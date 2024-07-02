<?php

use App\Http\Controllers\ApiController\ProvinceController;
use App\Http\Controllers\ApiController\CityController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'provinces', 'as' => 'provinces.'], function () {
    Route::get('index/{id?}', [ProvinceController::class, 'index'])->name('index');
    Route::post('store', [ProvinceController::class, 'store'])->name('store');
    Route::put('update/{id}', [ProvinceController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [ProvinceController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'cities', 'as' => 'cities.'], function () {
    Route::get('index/{province_id}', [CityController::class, 'index'])->name('index');
    Route::post('store', [CityController::class, 'store'])->name('store');
    Route::put('update/{id}', [CityController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [CityController::class, 'destroy'])->name('destroy');
});
