<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'trip_id' => ['required', 'exists:trips,id'],
            'people_number' => ['required', 'numeric'],
            'status' => ['required', 'in:paid,Paying,Canceled'],
            'amount' => ['required', 'integer', 'min:0'],

        ];
    }
    public function attributes(): array
    {
        return [
            'people_namber' => 'تعداد',
            'status' => 'وضعیت پرداخت',
            'amount' => 'قیمت'

        ];
    }
}
