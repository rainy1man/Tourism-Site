<?php

use App\Http\Controllers\ApiController\FaqController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'faq','as'=> 'faq.'] ,function () {
    Route::get('/', [FaqController::class, 'index'])->name('index');
    Route::post('/', [FaqController::class, 'store'])->name('store');
    Route::put('/{id}', [FaqController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [FaqController::class, 'destroy'])->name('destroy');
});
