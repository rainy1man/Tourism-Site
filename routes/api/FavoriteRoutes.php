<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\FavoriteController;

Route::put('favorite', [FavoriteController::class, 'change'])->name('favorite.change');

