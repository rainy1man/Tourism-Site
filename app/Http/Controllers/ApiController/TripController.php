<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripDetailResource;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $trips = new Trip();
        if($request->has('capacity')){
            $trips = $trips->where('capacity', '>=', $request->capacity);
        }
        if($request->has('start_date')){
            $trips = $trips->where('start_date', '>=', $request->start_date);
        }
        if($request->has('end_date')){
            $trips = $trips->where('end_date', '<=', $request->end_date);
        }
        if($request->has('price_min')){
            $trips = $trips->where('price_min', '>=', $request->price_min);
        }
        if($request->has('price_max')){
            $trips = $trips->where('price_max', '<=', $request->price_max);
        }
        if($request->has('city_id')){
            $trips = $trips->whereHas('tour', function($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
        }
        if($request->has('categories')){
            $trips = $trips->whereHas('tour.categories', function($q) use ($request) {
                $q->whereIn('category_id', $request->categories);
            });
        }
        $trips = $trips->orderBy('id', 'desc')->paginate(10);
        return TripDetailResource::collection($trips);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $trip = Trip::create($request->toArray());
        return new TripDetailResource($trip);
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
    return response()->json(['message' => 'Trip deleted successfully']);
    }
}
