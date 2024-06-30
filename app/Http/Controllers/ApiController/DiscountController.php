<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discount = Discount::all();
        return response()->json($discount);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $discount = Discount::create($request->toArray());


        return response()->json($discount);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $discount = Discount::find($id);
        if(!$discount) {
            return response()->json(['message' => 'Discount not found'], 404);
        }
        return response()->json($discount);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $discount = Discount::find($id);
        if(!$discount) {
            return response()->json(['message' => 'Discount not found'], 404);
        }
        $discount->update($request->toArray());
        return response()->json($discount);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discount = Discount::find($id);
        if(!$discount) {
            return response()->json(['message' => 'Discount not found'], 404);
        }
        $discount->delete();
        return response()->json(['message' => 'Discount deleted successfully']);
    }
}
