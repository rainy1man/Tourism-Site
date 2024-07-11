<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
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
            'xxx' => ['required', 'numeric'],
            'new_price' => ['required', 'numeric'],
            'trip_id' => ['required', 'exists:trips,id']
        ];
    }
    public function attributes(): array
    {
        return [
            'xxx' => '',
            'new_price' => 'قیمت جدید'
        ];
    }
}
