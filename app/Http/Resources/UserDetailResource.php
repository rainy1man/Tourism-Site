<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "phone_number" => $this->phone_number,
            "phone_number_emergency" => $this->phone_number_emergency,
            "national_code" => $this->national_code,
            "birth_date" => $this->birth_date,
            "gender" => $this->gender,
            "marital" => $this->marital,
            "card_number" => $this->card_number,
            "iban" => $this->iban,
            "email" => $this->email,
            "passengers" => $this->passengers()->get(),
            "favorites" => $this->favorites(),
            "orders" => CategorySummaryResource::collection($this->orders),
            // "avatar" => new MediaResource($this->getMedia('avatar'))
        ];
    }
}
