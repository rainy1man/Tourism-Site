<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        return $this->responseService->success_response($settings);

    }
    public function show(Request $request, $id)
    {
        $setting = Setting::find($id);
        $media = $setting->media;
        if($media)
        {
            $setting->with('media');
        }
        return $this->responseService->success_response($setting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, $id = null)
    {
        $value = $request->value;
        $setting = Setting::find($id);
        $setting->update(['value'=>$value]);
        if ($request->hasFile('logo')) {
            $setting->clearMediaCollection('logo');
            $setting->addMedia($request->file('logo'))->toMediaCollection('logo');
        }
         return $this->responseService->success_response($setting);

    }

}
