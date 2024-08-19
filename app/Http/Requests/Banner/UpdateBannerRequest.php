<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'banners' => 'required|array',
            'banners.*.id' => 'required|integer',
            'banners.*.filter' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'banners.*.id' => 'id',
            'banners.*.filter' => 'فیلتر',
        ];
    }

}
