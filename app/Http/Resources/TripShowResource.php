<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripShowResource extends JsonResource
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
            "tour_detail" => TourShowResource::make($this->tour),
            "price" => $this->price,
            "discount_price" => $this->discount_price,
            "capacity" => $this->capacity,
            "start_at" => $this->start_at,
            "end_at" => $this->end_at,
            "meal" => $this->id,
            "recommended" => $this->recommended,
            "popular" => $this->popular
        ];
    }
}
