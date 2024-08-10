<?php

use App\Http\Controllers\ApiController\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

