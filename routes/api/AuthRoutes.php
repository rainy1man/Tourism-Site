<?php

use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\ApiController\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::post('request_register', [AuthController::class, 'request_register'])->name('request_register');
Route::post('verify_register_code', [AuthController::class, 'verify_register_code'])->name('verify.register.code');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
Route::post('request_reset_password', [ResetPasswordController::class, 'request_reset_password'])->name('request.reset.password');
Route::post('verify_reset_password_code', [ResetPasswordController::class, 'verify_reset_password_code'])->name('verify.reset.password.code');
Route::post('reset_password', [ResetPasswordController::class, 'reset_password'])->name('reset.password');
Route::put('change_password', [AuthController::class, 'change_password'])->name('change.password')->middleware('auth:sanctum');
