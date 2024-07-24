<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/scores', [ScoreController::class, 'store']);
});
