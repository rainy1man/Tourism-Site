<?php

use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\ApiController\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('verify_login_code', [AuthController::class, 'verify_login_code'])->name('verify.login.code');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
Route::post('request_reset_password', [ResetPasswordController::class, 'request_reset_password'])->name('request.reset.password');
Route::post('verify_reset_password_code', [ResetPasswordController::class, 'verify_reset_password_code'])->name('verify.reset.password.code');
Route::post('reset_password', [ResetPasswordController::class, 'reset_password'])->name('reset.password');
Route::post('change_password', [ResetPasswordController::class, 'change_password'])->name('change.password');
