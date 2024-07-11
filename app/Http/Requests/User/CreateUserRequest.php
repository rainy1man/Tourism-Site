<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'first_name' => ['nullable','string', 'max:255'],
            'last_name' => ['nullable','string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255', 'unique'],
            'phone_number_emergency' => ['nullable','digits:11', 'regex:/(09)[0-9]{9}/', 'unique'],
            'email' => ['nullable','unique'],
            'password' => ['nullable','between:6,12', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
            'national_code' => ['nullable','unique','string', 'max:255'],
            'birth_date' => ['nullable','date', 'before:today'],
            'gender' => ['nullable','in:male,female'],
            'marital' => ['nullable','in:married,Single'],
            'card_number' => ['nullable','string', 'max:255'],
            'iban' => ['nullable','string', 'max:255'],

        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => 'نام',
            'last_name' => 'نام خانوادگی',
            'phone_number' => 'شماره همراه',
            'phone_number_emergency' => 'شماره تلفن همیشه در دسترس و ضروری',
            'email' => 'پست الکترونیک',
            'password' => 'رمز عبور',
            'national_code' => 'کد ملی',
            'birth_date' => 'تاریخ تولد',
            'gender' => 'جنسیت',
            'marital' => 'وضعیت تاهل',
            'card_number' => 'شماره کارت بانکی',
            'iban' => 'شماره شبا'
        ];
    }
}
