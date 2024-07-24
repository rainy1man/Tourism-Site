<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
       public function SwitchingFavorite(Request $request, $tour_id)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'ابتدا به حساب کاربری خود وارد شوید'], 401);
        }
     $favorite = Favorite::where('user_id', $user->id)
            ->where('tour_id', $tour_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'از علاقه مندی حذف شد'], 200);
        } else {
            $newFavorite = new Favorite();
            $newFavorite->user_id = $user->id;
            $newFavorite->tour_id = $tour_id;
            $newFavorite->save();
            return response()->json(['message' => 'به لیست علاقه مندی اضافه شد'], 201);
        }
    }
}
