<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Passenger\CreatePassengerRequest;
use App\Http\Requests\Passenger\UpdatePassengerRequest;
use App\Http\Resources\PassengerResource;
use App\Models\Order;
use App\Models\Passenger;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerController extends Controller
{
    public function store_in_order(CreatePassengerRequest $request, Order $order, Trip $trip)
    {
        $passengers = $request->input('passengers');
        $passenger_ids = [];

        // check trip capacity
        if (count($passengers) > $trip->capacity)
        {
            return response()->json(['error' => 'ظرفیت تور کافی نیست'], 400);
        }

        foreach ($passengers as $data)
        {
            $passenger = Passenger::where([
                ['first_name', $data['first_name']],
                ['last_name', $data['last_name']],
                ['national_code', $data['national_code']],
                ['birth_date', $data['birth_date']],
                ['gender', $data['gender']],
                ['user_id', Auth::id()],
                ['visibility', true]
            ])->first();

            if (!$passenger)
            {
                $passenger = new Passenger();
                $passenger->first_name = $data['first_name'];
                $passenger->last_name = $data['last_name'];
                $passenger->national_code = $data['national_code'];
                $passenger->birth_date = $data['birth_date'];
                $passenger->gender = $data['gender'];
                $passenger->user_id = Auth::id();
                $passenger->visibility = true;
                $passenger->save();
            }

            $passenger_ids[] = $passenger->id;
        }

        $order->passengers()->attach($passenger_ids);
        return $this->responseService->success_response();
    }

    public function store(CreatePassengerRequest $request)
    {
        $data = $request->except('visibility');
        $data['user_id'] = Auth::id();
        $passenger = Passenger::create($data);
        return PassengerResource::make($passenger);
    }

    public function update(UpdatePassengerRequest $request, string $id)
    {
        $passenger = Passenger::find($id);
        if ($passenger->user_id !== Auth::id())
        {
            return $this->responseService->unauthorized_response();
        }
        if (!$passenger)
        {
            return $this->responseService->notFound_response('مسافر');
        }
        $data = $request->except(['user_id', 'visibility']);
        $passenger->update($data);
        return PassengerResource::make($passenger);
    }


    public function destroy(string $id)
    {
        $passenger = Passenger::find($id);
        if (Auth::id() == $passenger->user_id)
        {
            if (!$passenger)
            {
                return $this->responseService->notFound_response('مسافر');
            }
            $passenger->update([
                "visibility" => false
            ]);
            return $this->responseService->delete_response('مسافر');
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}
