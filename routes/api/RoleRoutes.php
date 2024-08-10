<?php

use App\Http\Controllers\ApiController\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
    Route::get('/', [RoleController::class, 'role_index'])->name('index');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::put('/{id}', [RoleController::class, 'update'])->name('update');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('destroy');
    Route::post('update_permissions/{id}', [RoleController::class, 'update_role_permissions'])->name('update.permissions');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('show_roles/{id}', [RoleController::class, 'show_user_roles'])->name('show.roles');
    Route::post('update_role/{id}', [RoleController::class, 'update_user_role'])->name('update.role');
    Route::get('show_permissions/{id}', [RoleController::class, 'show_user_permissions'])->name('show.permissions');
    Route::post('update_permissions/{id}', [RoleController::class, 'update_user_permissions'])->name('update.permissions');
});

    Route::get('permissions/index', [RoleController::class, 'permission_index'])->name('permissions.index');

