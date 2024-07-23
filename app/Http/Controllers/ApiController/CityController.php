<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = new City();
        if ($request->available){
            $cities = $cities->whereHas('tours');
            return $this->responseService->success_response($cities);
        }
        $cities = $cities->all();
        return $this->responseService->success_response($cities);
    }
}
