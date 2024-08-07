<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{

    public function upload(Request $request, $model_type, $model_id)
    {
        if ($request->user()->can('create.media'))
        {
            $model = null;

            switch ($model_type)
            {
                case 'main_image':
                    $model = Tour::find($model_id);
                    if ($request->hasFile('main_image'))
                    {
                        $model->addMedia($request->file('main_image'))->toMediaCollection('main_image', 'local');
                    }
                    break;
                case 'additional_images':
                    $model = Tour::find($model_id);
                    if ($request->hasFile('additional_images'))
                    {
                        $model->addMedia($request->file('additional_images'))->toMediaCollection('additional_images', 'local');
                    }
                    break;
                case 'tour_journey':
                    $model = Tour::find($model_id);
                    if ($request->hasFile('tour_journey'))
                    {
                        $model->addMedia($request->file('tour_journey'))->toMediaCollection('tour_journey', 'local');
                    }
                    break;
                case 'logo':
                    $model = Setting::find($model_id);
                    if ($request->hasFile('logo'))
                    {
                        $model->addMedia($request->file('logo'))->toMediaCollection('logo', 'local');
                    }
                    break;
                case 'avatar':
                    $model = User::find($model_id);
                    if ($request->hasFile('avatar'))
                    {
                        $model->addMedia($request->file('avatar'))->toMediaCollection('avatar', 'local');
                    }
                    break;
            }
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    public function destroy(Request $request)
    {
        if($request->user()->can('delete.media'))
        {
            $media_ids = $request->input('media_ids');
            Media::destroy($media_ids);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

}
