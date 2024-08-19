<?php

use App\Http\Controllers\ApiController\BannerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'banner','as'=> 'banner.'] ,function () {
    Route::get('/', [BannerController::class, 'index'])->name('index')->withoutMiddleware('auth:sanctum');
    Route::put('/', [BannerController::class, 'update'])->name('update');
});
