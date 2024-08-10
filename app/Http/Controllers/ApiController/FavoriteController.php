<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function updateOrCreate(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $favorite = Favorite::where('user_id', $user->id)
                ->where('tour_id', $request->tour_id)
                ->first();
            if ($favorite) {
                $favorite->delete();
                return $this->responseService->success_response();
            } else {
                $new_favorite = new Favorite();
                $new_favorite->user_id = $user->id;
                $new_favorite->tour_id = $request->tour_id;
                $new_favorite->save();
                return $this->responseService->success_response();
            }
        } else {
            return $this->responseService->unauthorized_response();
        }
    }
}
