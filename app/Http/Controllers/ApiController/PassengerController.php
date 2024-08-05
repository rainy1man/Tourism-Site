<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passenger = Passenger::all();
        return response()->json($passenger);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $passenger = Passenger::create($request->toArray());
        return response()->json($passenger);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if ($request->user()->can('see.passenger')) {
            $passengers = Passenger::where('user_id', $id)->all();
            return $this->responseService->success_response($passengers);
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $passenger = Passenger::find($id);
        if(!$passenger) {
            return response()->json(['message' => 'Passenger not found'], 404);
        }
        $passenger->update();
        return response()->json($passenger);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $passenger = Passenger::find($id);
        if(!$passenger) {
            return response()->json(['message' => 'Passenger not found'], 404);
        }
        $passenger->delete();
        return response()->json(['message' => 'Passenger deleted successfully']);
    }
}
