<?php

use App\Http\Controllers\ApiController\CommentController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'comment','as'=> 'comment.'] ,function () {
    Route::get('/', [CommentController::class, 'all'])->name('all');
    Route::get('/', [CommentController::class, 'index'])->name('index')->withoutMiddleware('auth:sanctum');
    Route::post('/{tour}', [CommentController::class, 'store'])->name('store');
    Route::put('/', [CommentController::class, 'changestatus'])->name('changestatus');
    Route::delete('destroy/{id}', [CommentController::class, 'destroy'])->name('destroy');
});
