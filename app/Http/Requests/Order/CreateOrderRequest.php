<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'trip_id' => ['required', 'exists:trips,id'],
            'adults_number' => ['required', 'numeric'],
            'children_number' => ['nullable', 'numeric'],
        ];
    }
    public function attributes(): array
    {
        return [
            'user_id' => 'شناسه کاربر',
            'trip_id' => 'شناسه سفر',
            'adult_number' => 'تعداد بزرگسال',
            'children_number' => 'تعذاد کودک',
        ];
    }
}
