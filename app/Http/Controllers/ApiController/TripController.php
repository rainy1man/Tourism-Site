<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trip = Trip::all();
        return response()->json($trip);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $trip = Trip::create($request->toArray());
        return response()->json($trip);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trip = Trip::find($id);
        if(!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }
        return response()->json($trip);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $trip = Trip::find($id);
        if(!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }
        $trip->update();
        return response()->json($trip);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trip = Trip::find($id);
        if(!$trip) {
        return response()->json(['message' => 'Trip not found'], 404);
    }
    $trip->delete();
    return response()->json(['message' => 'Trip deleted successfully'], 404);
    }
}
