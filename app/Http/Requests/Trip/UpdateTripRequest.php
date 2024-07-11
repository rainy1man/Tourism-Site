<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
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
            'tour_id' => ['required', 'exists:tours,id'],
            'price' => ['required', 'integer', 'min:0'],
            'capacity' => ['required', 'integer', 'min:1'],
            'start_at' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_at' => ['required', 'date_format:Y-m-d', 'after:start_at'],
            'meal' => ['required', 'in:BB,HB,FB,AI'],
            'transport' => ['required', 'in:train,bus,airplane'],
            'stay_class' => ['required', 'in:economy,business,first_class'],
        ];
    }
    public function attributes()
    {
        return [
            'price' => 'قیمت',
            'capacity' => 'ظرفیت',
            'start_at' => 'تاریخ شروع',
            'end_at' => 'تاریخ پایان',
            'meal' => 'وعده غذایی',
            'transport' => 'نوع وسیله نقلیه تور',
            'stay_class' => 'نوع پرواز',
        ];
    }
}
