<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::with(['media'])->paginate(4);

        return $this->responseService->success_response($banners);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        if ($request->hasRole('super_admin'))
        {

        $banner = Banner::findOrFail($id);


        if ($request->hasFile('header_banner')) {

            $banner->clearMediaCollection('header_banner');

            $banner->addMedia($request->file('header_banner'))->toMediaCollection('header_banner', 'local');
        }

        if ($request->hasFile('middle_banner')) {

            $banner->clearMediaCollection('middle_banner');

            $banner->addMedia($request->file('middle_banner'))->toMediaCollection('middle_banner', 'local');
        }

        if ($request->hasFile('bottom_banner')) {

            $banner->clearMediaCollection('bottom_banner');

            $banner->addMedia($request->file('bottom_banner'))->toMediaCollection('bottom_banner', 'local');
        }

        return $this->responseService->success_response();
        }



    }

    /**
     * Display the specified resource.
     */

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request, $id)
    {
        if ($request->hasRole('super_admin'))
        {
            $banner = Banner::findOrFail($id);
            $banner->media()->delete();
            return $this->responseService->success_response();
        }

    }
}
