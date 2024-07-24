<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Order;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $tourId = $request->input('tour_id');
        $scoreValue = $request->input('score');


        $Purchased = Order::where('user_id', $user->id)
            ->whereHas('trip', function ($query) use ($tourId) {
                $query->where('tour_id', $tourId);
            })
            ->where('order_status', 'completed')
            ->exists();

        if (!$Purchased) {
            return response()->json(['خطا' => 'شما مجاز به انجام این عملیات نیستید'], 403);
        }


        $score = Score::updateOrCreate(
            ['user_id' => $user->id, 'tour_id' => $tourId],
            ['score' => $scoreValue]
        );

        return response()->json(['پیام' => 'امتیاز شما ثبت گردید', 'score' => $score]);
    }
}
