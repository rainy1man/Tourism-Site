<?php

namespace App\Http\Requests\Passenger;

use Illuminate\Foundation\Http\FormRequest;

class CreatePassengerRequest extends FormRequest
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
            'first_name' => ['required','string', 'max:255'],
            'last_name' => ['required','string', 'max:255'],
            'national_code' => ['required','unique','string', 'max:255'],
            'birth_date' => ['required','date', 'before:today'],
            'gender' => ['required','in:male,female'],
            'user_id' => ['required', 'exists:users,id']
        ];
    }
    public function attributes(): array
    {
        return [
            'first_name' => 'نام',
            'last_name' => 'نام خانوادگی',
            'national_code' => 'کد ملی',
            'birth_date' => 'تاریخ تولد',
            'gender' => 'جنسیت',
        ];
    }
}
