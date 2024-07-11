<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users,phone_number,' . $this->user],
            'phone_number_emergency' => ['required', 'digits:11', 'regex:/(09)[0-9]{9}/', 'unique:users,phone_number_emergency,' . $this->user],
            'email' => ['required', 'unique:users,email,' . $this->user],
            'password' => ['required', 'between:6,12', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
            'national_code' => ['required','unique:users,national_code' . $this->user,'string', 'max:255'],
            'birth_date' => ['required','date', 'before:today'],
            'gender' => ['required','in:male,female'],
            'marital' => ['required', 'in:married,Single'],
            'card_number' => ['required', 'string', 'max:255'],
            'iban' => ['required', 'string', 'max:255'],

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
