<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Passenger\CreatePassengerRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Show Order
    public function show(Request $request, string $id)
    {
        $order = Order::find($id);
        if ($request->user()->can('see.order') || $request->user()->id == $order->user_id)
        {
            if (!$order)
            {
                return $this->responseService->notFound_response();
            }
            return $this->responseService->success_response($order);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    public function store(Request $request, Trip $trip)
    {
        if ($trip->capacity == 0)   // check trip capacity
        {
            return response()->json(['error' => 'ظرفیت تور تکمیل است']);
        }

        $user = Auth::user();
//        $user_data = collect($user->getAttributes())->except(['iban', 'card_number']);  // check all user attributes except iban and card_number
//        foreach ($user_data as $data)
//        {
//            if (is_null($data))
//            {
//                return response()->json(['error' => 'لطفا ابتدا پروفایل خود را تکمیل کنید'], 400);
//            }
//        }

        // check if a trip has discount
        if ($trip->discount_price)
        {
            $price = $trip->discount_price;
        }
        else
        {
            $price = $trip->price;
        }
        $total_amount = ($request->adults_number * $price) + ($request->children_number * ($price / 2));    // calculate total amount
        $order = Order::create([
            'user_id' => Auth::id(),
            'trip_id' => $trip->id,
            'adults_number' => $request->adults_number,
            'children_number' => $request->children_number,
            'total_amount' => $total_amount
        ]);

        $passengerRequest = CreatePassengerRequest::createFromBase($request);
        $passengerRequest->setUserResolver(function () use ($request) {
            return $request->user();
        });
        app(PassengerController::class)->store_in_order($passengerRequest, $order, $trip);

        return OrderResource::make($order);
    }

    public function change_status(Request $request, string $id)
    {
        $order = Order::find($id);
        if ($request->user()->id == $order->user_id)
        {
            $order->order_status = 'completed';
            $order->payment_status = 'paid';
            $order->save();
            $passengers = DB::table('order_passenger')->where('order_id', $id)->count();

            $trip = Trip::find($order->trip_id);
            $trip->decrement('capacity', $passengers);

            return OrderResource::make($order);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}
