<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = Detail::all();
        return response()->json($detail);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $detail = Detail::create($request->toArray());
        return response()->json($detail);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detail = Detail::find($id);
        if(!$detail) {
            return response()->json(['message' => 'Detail not found'], 404);
        }
        return response()->json($detail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $detail = Detail::find($id);
        if(!$detail) {
            return response()->json(['message' => 'Detail not found'], 404);
        }
        $detail->update();
        return response()->json($detail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail = Detail::find($id);
        if(!$detail) {
            return response()->json(['message' => 'Detail not found'], 404);
        }
        $detail->delete();
        return response()->json(['message' => 'Detail deleted successfully']);
    }
}
