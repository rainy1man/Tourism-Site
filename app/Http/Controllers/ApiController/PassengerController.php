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
        $passenger = Passenger::create($request->merge(['user_id' => Auth::id()])->toArray());
        return $this->responseService->success_response(PassengerResource::make($passenger));
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
        $passenger->update($request->except('user_id'));
        return $this->responseService->success_response(PassengerResource::make($passenger));
    }


    public function destroy(string $id)
    {
        $passenger = Passenger::find($id);
        if (!$passenger) {
            return response()->json(['message' => 'Passenger not found'], 404);
        }
        $passenger->delete();
        return response()->json(['message' => 'Passenger deleted successfully']);
    }
}
