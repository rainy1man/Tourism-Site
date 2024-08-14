<?php

use App\Http\Controllers\ApiController\CommentController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'comment','as'=> 'comment.'] ,function () {
    Route::get('all', [CommentController::class, 'all'])->name('all');
    Route::get('index', [CommentController::class, 'index'])->name('index')->withoutMiddleware('auth:sanctum');
    Route::post('/{tour}', [CommentController::class, 'store'])->name('store');
    Route::put('/{id}', [CommentController::class, 'change_status'])->name('change_status');
    Route::delete('/{id}', [CommentController::class, 'destroy'])->name('destroy');
    Route::get('score', [CommentController::class, 'score'])->name('score')->withoutMiddleware('auth:sanctum');
});
