<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\FavoriteController;

Route::group(['prefix'=> 'favorite', 'as' => 'favorite.' , 'middleware'=> 'auth:sanctum'], function (){
    Route::get('/',[FavoriteController::class, 'index'])->name('index');
    Route::get('/{id}',[FavoriteController::class, 'show'])->name('show');
    Route::post('updateOrCreate',[FavoriteController::class, 'updateOrCreate'])->name('updateOrCreate');
});
