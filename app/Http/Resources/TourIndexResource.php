<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->resource->loadCount('comments')->loadAvg('comments', 'score');
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "transport" => $this->transport,
            "city_id" => $this->city_id,
            "stay_class" => $this->stay_class,
            "details" => $this->details,
            "comments_count" => $this->comments_count,
            "average_score" => number_format($this->comments_avg_score, 2),
            "categories" => CategorySummaryResource::collection($this->categories),
            "city" => CityResource::make($this->city),
            "main_image" => MediaResource::collection($this->getMedia('main_image')),
            "additional_images" => MediaResource::collection($this->getMedia('additional_images')),
            "tour_journey" => MediaResource::collection($this->getMedia('tour_journey'))
        ];
    }
}
