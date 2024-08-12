<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassengerResource;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->except('visibility');
        $data['user_id'] = Auth::id();
        $passenger = Passenger::create($data);
        return PassengerResource::make($passenger);
    }

    public function update(Request $request, string $id)
    {
        $passenger = Passenger::find($id);
        if (!$passenger) {
            return $this->responseService->notFound_response('مسافر');
        }
        if ($passenger->user_id !== Auth::id()) {
            return $this->responseService->unauthorized_response();
        }
        $data = $request->except(['user_id', 'visibility']);
        $passenger->update($data);
        return PassengerResource::make($passenger);
    }


    public function destroy(string $id)
    {
        $passenger = Passenger::find($id);
        if (!$passenger) {
            return $this->responseService->notFound_response('مسافر');
        }
        $passenger->update([
            "visibility" => false
        ]);
        return $this->responseService->delete_response('مسافر');
    }
}
