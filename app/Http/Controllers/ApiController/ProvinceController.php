<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $province = Province::all();
        return response()->json($province);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $province = Province::create($request->toArray());
        return response()->json($province);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $province = Province::find($id);
        if(!$province) {
            return response()->json(['message' => 'Province not found'], 404);
        }
        return response()->json($province);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $province = Province::find($id);
        if(!$province) {
            return response()->json(['message' => 'Province not found'], 404);
        }
        $province->update();
        return response()->json($province);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $province = Province::find($id);
        if(!$province) {
            return response()->json(['message' => 'Province not found'], 404);
        }
        $province->delete();
        return response()->json(['message' => 'Province deleted successfully']);
    }
}
