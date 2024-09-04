<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourIndexResource;
use App\Http\Resources\TourResource;
use App\Http\Resources\TourShowResource;
use App\Models\Post;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    //
    public function index()
    {
        $tours = Tour::withCount('comments')
            ->withAvg('comments', 'score')
            ->orderBy('id', 'desc')
            ->paginate(6);
        return TourIndexResource::collection($tours);
    }

    public function store(Request $request)
    {
        $tour = Tour::create($request->toArray());
        $tour->categories()->attach($request->category_ids);
        app(MediaController::class)->upload($request, 'main_image', $tour->id);
        app(MediaController::class)->upload($request, 'additional_images', $tour->id);

        if ($request->has('tour_journeys')) {
            foreach ($request->tour_journeys as $tour_journey) {
                $post = Post::create([
                    'tour_id' => $tour->id,
                    'text' => $tour_journey['text'],
                ]);

                    $post->addMedia($tour_journey['image'])->toMediaCollection('tour_journey', 'public');
            }
        }

        return TourShowResource::make($tour);
    }

    public function show(string $id)
    {
        $tour = Tour::find($id);
        if (!$tour) {
            return $this->responseService->unauthorized_response();
        }
        return TourShowResource::make($tour);
    }

    public function update(Request $request, string $id)
    {
        $tour = Tour::find($id);
        if (!$tour) {
            return $this->responseService->notFound_response('تور');
        }
        $data = $request->except(['transport', 'stay_class', 'city_id']);
        $tour->update($data);
        return $this->responseService->success_response($tour);
    }

    public function destroy(string $id)
    {
        $tour = Tour::find($id);
        if (!$tour) {
            return response()->json(['message' => 'Tour not found'], 404);
        }
        $tour->delete();
        return $this->responseService->delete_response('تور');
    }
}
