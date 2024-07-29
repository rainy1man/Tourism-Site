<?php

use App\Http\Controllers\ApiController\PassengerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

Route::group(['prefix' => 'passenger', 'as' => 'passenger.'], function () {
    Route::get('/{user?}', [PassengerController::class, 'index'])->name('index');
    Route::post('/', [PassengerController::class, 'store'])->name('store');
    Route::get('{id}', [PassengerController::class, 'show'])->name('show');
    Route::put('{id}', [PassengerController::class, 'update'])->name('update');
    Route::delete('{id}', [PassengerController::class, 'destroy'])->name('destroy');
});

});
