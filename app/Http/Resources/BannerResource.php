<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $media = null;
        switch ($this->banner_type)
        {
            case 'header':
                $media = MediaResource::collection($this->getMedia('header_banner'));
                break;
            case 'middle':
                $media = MediaResource::collection($this->getMedia('middle_banner'));
                break;
            case 'bottom':
                $media = MediaResource::collection($this->getMedia('bottom_banner'));
                break;
        }

        return [
            'id' => $this->id,
            'filter' => $this->filter,
            'banner_type' => $this->banner_type,
            'position' => $this->position,
            'media' => $media,
        ];
    }
}
