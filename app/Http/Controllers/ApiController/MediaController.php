<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserDetailResource;
use App\Models\Banner;
use App\Models\Post;
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
                        $model->addMedia($request->file('main_image'))->toMediaCollection('main_image', 'public');
                    }
                    break;
                case 'additional_images':
                    $model = Tour::find($model_id);
                    if ($request->hasFile('additional_images'))
                    {
                        foreach ($request->additional_images as $image) {
                                    $model->addMedia($image)->toMediaCollection('additional_images', 'public');
                                }
                    }
                    break;
                case 'tour_journeys':
                    $tour = Tour::find($model_id);
                        foreach ($request->tour_journeys as $tour_journey) {
                            $post = Post::create([
                                'tour_id' => $tour->id,
                                'text' => $tour_journey['text'],
                            ]);

                                $post->addMedia($tour_journey['image'])->toMediaCollection('tour_journey', 'public');
                        }

                    break;
                case 'logo':
                    $model = Setting::find($model_id);
                    if ($request->hasFile('logo'))
                    {
                        $model->addMedia($request->file('logo'))->toMediaCollection('logo', 'public');
                    }
                    break;
                case 'avatar':
                    $model = User::find($model_id);
                    if ($request->hasFile('avatar'))
                    {
                        $model->addMedia($request->file('avatar'))->toMediaCollection('avatar', 'private');
                        return UserDetailResource::make($model);
                    }
                    break;
                case 'header_banner':
                    $model = Banner::find($model_id);
                    if ($request->hasFile('header_banner'))
                    {
                        $model->addMedia($request->file('header_banner'))->toMediaCollection('header_banner', 'public');
                    }
                    break;
                case 'middle_banner':
                    $model = Banner::find($model_id);
                    if ($request->hasFile('middle_banner'))
                    {
                        $model->addMedia($request->file('middle_banner'))->toMediaCollection('middle_banner', 'public');
                    }
                    break;
                case 'bottom_banner':
                    $model = Banner::find($model_id);
                    if ($request->hasFile('bottom_banner'))
                    {
                        $model->addMedia($request->file('bottom_banner'))->toMediaCollection('bottom_banner', 'public');
                        return $this->responseService->success_response($model);
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
