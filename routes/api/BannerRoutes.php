<?php

use App\Http\Controllers\ApiController\BannerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'banner','as'=> 'banner.'] ,function () {
    Route::get('/', [BannerController::class, 'index'])->name('index');
    Route::post('store/{id}', [BannerController::class, 'store'])->name('store');
    Route::delete('destroy/{id}', [BannerController::class, 'destroy'])->name('destroy');
});
