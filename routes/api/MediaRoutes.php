<?php

use App\Http\Controllers\ApiController\MediaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
    Route::post('download', [MediaController::class, 'download'])->name('download');
    Route::post('upload/{model_type}/{model_id}', [MediaController::class, 'upload'])->name('upload');
    Route::put('update/{id}', [MediaController::class, 'update'])->name('update');
    Route::delete('destroy/{modelType}/{modelId}/{mediaId}', [MediaController::class, 'destroy'])->name('destroy');
});
