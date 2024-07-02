<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $city = City::all();
        return response()->json($city);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $city = City::create($request->toArray());
        return response()->json($city);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::find($id);
        if(!$city) {
            return response()->json(['message' => 'City not found', 404]);
        }
        return response()->json($city);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $city = City::find($id);
        if(!$city) {
            return response()->json(['message' => 'City not found', 404]);
        }
        $city->update($request->toArray());
        return response()->json($city);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::find($id);
        if(!$city) {
            return response()->json(['message' => 'City not found', 404]);
        }
        $city->delete();
        return response()->json(['message' => 'City deleted successfully']);
    }
}
