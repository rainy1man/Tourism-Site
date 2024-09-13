<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Passenger\CreatePassengerRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Show Order
    public function show(Request $request, string $id)
    {
        $order = Order::find($id);
        if ($request->user()->can('see.order') || $request->user()->id == $order->user_id) {
            if (!$order) {
                return $this->responseService->notFound_response();
            }
            return $this->responseService->success_response($order);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function store(CreateOrderRequest $request, Trip $trip)
    {
        if ($trip->capacity == 0)   // check trip capacity
        {
            return response()->json(['error' => 'ظرفیت تور تکمیل است']);
        }

        $user = Auth::user();
        $user_data = collect($user->getAttributes())->except(['iban', 'card_number', 'deleted_at', 'email_verified_at', 'remember_token']);  // check all user attributes except iban and card_number
        foreach ($user_data as $data) {
            if (is_null($data)) {
                return response()->json(['error' => 'لطفا ابتدا پروفایل خود را تکمیل کنید'], 400);
            }
        }

        // check if a trip has discount
        if ($trip->discount_price) {
            $price = $trip->discount_price;
        } else {
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
        if ($request->user()->id == $order->user_id) {
            $order->order_status = 'completed';
            $order->payment_status = 'paid';
            $order->save();
            $passengers = DB::table('order_passenger')->where('order_id', $id)->count();

            $trip = Trip::find($order->trip_id);
            $trip->decrement('capacity', $passengers);

            return OrderResource::make($order);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    public function monthly_sales($date, string $id = null)
    {
        $end_date = Carbon::parse($date);
        $start_date = $end_date->copy()->subDays(30);

        $total_sales = Order::whereBetween('created_at', [$start_date, $end_date])
            ->where('payment_status', 'paid');
        if ($id !== null) {
            $total_sales->whereHas('trip', function ($query) use ($id) {
                $query->where('tour_id', $id);
            });
        }
        $total_sales = $total_sales->sum('total_amount');

        return $this->responseService->success_response($total_sales);
    }

    public function average_sales($date)
    {
        $end_date = Carbon::parse($date);
        $start_date = $end_date->copy()->subDays(30);

        // دریافت تمامی تورهایی که در یک ماه گذشته سفارش داشته‌اند
        $trips = Trip::whereHas('orders', function ($query) use ($start_date, $end_date) {
            $query->whereBetween('created_at', [$start_date, $end_date])
                  ->where('payment_status', 'paid');
        })->get();

        // محاسبه مجموع درصد فروش
        $total_percentage = 0;
        $trip_count = $trips->count();

        foreach ($trips as $trip) {
            // تعداد کل مسافران رزرو شده برای این تور
            $sold_passengers = $trip->orders()
                ->whereBetween('created_at', [$start_date, $end_date])
                ->where('payment_status', 'paid')
                ->sum(DB::raw('adults_number + children_number'));

            // محاسبه درصد فروش این تور
            if ($trip->capacity > 0) {
                $percentage = ($sold_passengers / $trip->capacity) * 100;
                $total_percentage += $percentage;
            }
        }

        // محاسبه میانگین درصد فروش
        if ($trip_count > 0) {
            $average_percentage = $total_percentage / $trip_count;
        } else {
            $average_percentage = 0; // اگر هیچ توری در این بازه فروخته نشده باشد
        }

        // قالب‌بندی میانگین درصد فروش تا دو رقم اعشار
        $formatted_percentage = number_format($average_percentage, 2);

        return $this->responseService->success_response($formatted_percentage);
    }

    public function total_sales($date)
{
    $end_date = Carbon::parse($date);
    $start_date = $end_date->copy()->subDays(30);

    // محاسبه تعداد کل مسافران فروخته شده (بزرگسالان و کودکان) در یک ماه گذشته
    $total_sold_capacity = Order::whereBetween('created_at', [$start_date, $end_date])
        ->where('payment_status', 'paid')
        ->sum(DB::raw('adults_number + children_number'));

    return $this->responseService->success_response($total_sold_capacity);
}


}
