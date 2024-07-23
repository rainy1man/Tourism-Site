<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    //
    public function index()
    {
        $tours = new Tour();
        $tours = $tours->all();
        return $this->responseService->success_response($tours);
    }

    //
    public function store(Request $request)
    {
        $tour = Tour::create($request->toArray());
        return $this->responseService->success_response($tour);
    }

    //
    public function show(string $id)
    {
        $tour = Tour::find($id);
        if (!$tour) {
            return $this->responseService->unauthorized_response();
        }
        return $this->responseService->success_response($tour);
    }

    //
    public function update(Request $request, string $id)
    {
        $tour = Tour::find($id);
        if (!$tour) {
            return response()->json(['message' => 'Tour not found'], 404);
        }
        $tour->Update();
        return $this->responseService->success_response($tour);

    }
    //
    public function destroy(string $id)
    {
        $tour = Tour::find($id);
        if (!$tour) {
            return response()->json(['message' => 'Tour not found'], 404);
        }
        $tour->delete();
        return response()->json(['message' => 'Tour deleted successfully']);
    }
}
