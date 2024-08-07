<?php

use App\Http\Controllers\ApiController\MediaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
    Route::post('/{model_type}/{model_id}', [MediaController::class, 'upload'])->name('upload');
    Route::delete('/', [MediaController::class, 'destroy'])->name('destroy');
});
