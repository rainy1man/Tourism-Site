<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('test', function () {
    //
})->name('test');

Route::middleware('auth:sanctum')->group(function () {
    require __DIR__ . '/api/CommentRoutes.php';
    require __DIR__ . '/api/FavoriteRoutes.php';
    require __DIR__ . '/api/NotficationRoutes.php';
    require __DIR__ . '/api/OrderRoutes.php';
    require __DIR__ . '/api/PassengerRoutes.php';
    require __DIR__ . '/api/SettingRoutes.php';
    require __DIR__ . '/api/TourRoutes.php';
    require __DIR__ . '/api/TripRoutes.php';
    require __DIR__ . '/api/UserRoutes.php';
    require __DIR__ . '/api/MediaRoutes.php';
    require __DIR__ . '/api/RefundRoutes.php';
    require __DIR__ . '/api/RoleRoutes.php';
    require __DIR__ . '/api/BannerRoutes.php';
});
require __DIR__ . '/api/AuthRoutes.php';
require __DIR__ . '/api/CategoryRoutes.php';
require __DIR__ . '/api/CityRoutes.php';
require __DIR__ . '/api/FaqRoutes.php';
