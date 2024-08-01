<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "transport" => $this->transport,
            "city_id" => $this->city_id,
            "stay_class" => $this->stay_class,
            "details" => $this->details,
            "categories" => CategorySummaryResource::collection($this->categories),
            "city" => new CityResource($this->city),
            "main_image" => MediaResource::collection($this->getMedia('main_image'))
        ];
    }
}
