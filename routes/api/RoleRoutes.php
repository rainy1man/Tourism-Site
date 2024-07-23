<?php

use App\Http\Controllers\ApiController\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
    Route::get('/', [AuthController::class, 'role_index'])->name('index');
    Route::post('/', [AuthController::class, 'store'])->name('store');
    Route::put('/{id}', [AuthController::class, 'update'])->name('update');
    Route::delete('/{id}', [AuthController::class, 'destroy'])->name('destroy');
    Route::post('update_permissions/{id}', [AuthController::class, 'update_role_permissions'])->name('update_permissions');
});

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('show_roles/{id}', [AuthController::class, 'show_user_roles'])->name('show_roles');
    Route::post('update_roles/{id}', [AuthController::class, 'update_user_roles'])->name('update_roles');
    Route::get('show_permissions/{id}', [AuthController::class, 'show_user_permissions'])->name('show_permissions');
    Route::post('update_permissions/{id}', [AuthController::class, 'update_user_permissions'])->name('update_permissions');
});

    Route::get('permissions/index', [AuthController::class, 'permission_index'])->name('permissions.index');

