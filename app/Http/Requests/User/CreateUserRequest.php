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
            'firstName' => ['required'],
            'lastName' => ['required'],
            'nationalCode' => ['required', 'unique:users,nationalCode,' . $this->user],
            'phoneNumber' => ['required', 'digits:11', 'regex:/(09)[0-9]{9}/', 'unique:users,phoneNumber,' . $this->user],
            'email' => ['required', 'unique:users,email,' . $this->user]
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
