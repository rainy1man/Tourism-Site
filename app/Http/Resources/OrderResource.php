<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'trip_name' => $this->trip->tour->title,
            'children_number' => $this->children_number,
            'adults_number' => $this->adults_number,
            'start_at' => $this->trip->start_at,
            'end_at' => $this->trip->end_at,
            'total_amount' => $this->total_amount
        ];
    }
}
