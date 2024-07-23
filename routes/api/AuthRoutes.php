<?php

use App\Http\Controllers\ApiController\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
Route::post('forgot_password', [AuthController::class, 'forgot_password'])->name('forgot_password');
Route::post('reset_password', [AuthController::class, 'reset_password'])->name('reset_password');
