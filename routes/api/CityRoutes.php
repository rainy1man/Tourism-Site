<?php

use App\Http\Controllers\ApiController\CityController;
use Illuminate\Support\Facades\Route;

Route::get('cities/', [CityController::class, 'index'])->name('cities.index');

