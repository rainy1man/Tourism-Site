<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\FavoriteController;


Route::post('/favorites/switch/{tour_id}', [FavoriteController::class, 'SwitchingFavorite']);
