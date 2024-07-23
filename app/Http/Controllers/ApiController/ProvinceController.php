<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return $this->responseService->success_response($provinces);
    }

    public function store()
    {
        $provinces = Province::create();
        return $this->responseService->success_response($provinces);
    }

}
