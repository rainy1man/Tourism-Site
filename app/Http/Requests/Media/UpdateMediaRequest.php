<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'model_id' => ['required', 'integer'],
            'model_type' => ['required', 'string'],
            'uuid' => ['nullable', 'uuid', 'unique:media,uuid,' . $this->route('media')], // UUID باید منحصر به فرد باشد اما خود رکورد فعلی را مستثنی کند
            'collection_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
            'mime_type' => ['nullable', 'string', 'max:255'],
            'disk' => ['required', 'string', 'max:255'],
            'conversions_disk' => ['nullable', 'string', 'max:255'],
            'size' => ['required', 'integer', 'min:1'],
            'manipulations' => ['required', 'json'],
            'custom_properties' => ['required', 'json'],
            'generated_conversions' => ['required', 'json'],
            'responsive_images' => ['required', 'json'],
            'order_column' => ['nullable', 'integer'],
        ];
    }
}
