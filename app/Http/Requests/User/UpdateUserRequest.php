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
            'first_name' => "required",
            'lastName' => "required",
            'nationalCode' => "required|unique:users,nationalCode",
            'phoneNumber' => ['required', 'digits:11', 'unique:users,phoneNumber', 'regex:/(09)[0-9]{9}/'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'between:6,12', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/']
        ];
    }

    public function attributes(): array
    {
        return [
            'password' => 'رمز عبور',
            'email' => 'ایمیل',
            'phoneNumber' => 'شماره همراه',
            'codeMelli' => 'کد ملی',
            'name' => 'نام و نام خانوادگی'
        ];
    }
}
