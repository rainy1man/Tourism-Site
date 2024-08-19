<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banners = new Banner();
        if ($request->type)
        {
            $banners = $banners->where('banner_type', $request->type)->orderBy('position','asc')->get();
        }
            return BannerResource::collection($banners);
    }

    public function update(UpdateBannerRequest $request)
    {
        if ($request->user()->can('update.banner'))
        {
            $banners = [];
            foreach ($request->banners as $banner_data)
            {
                $banner = Banner::find($banner_data['id']);
                $banner->update(['filter' => $banner_data['filter']]);
                $banners[] = $banner;
            }
            return $this->responseService->success_response($banners);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}
