<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->hasRole('super_admin'))
        {
            $settings = Setting::all();
            return SettingResource::collection($settings);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }

    }
    public function show(Request $request, string $id)
    {
        $setting = Setting::find($id);
        return SettingResource::make($setting);
    }

    public function update(UpdateSettingRequest $request, string $id)
    {
        if ($request->user()->hasRole('super_admin'))
        {
            $value = $request->value;
            $setting = Setting::find($id);
            $setting->update(['value' => $value]);
            return $this->responseService->success_response($setting);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

}


