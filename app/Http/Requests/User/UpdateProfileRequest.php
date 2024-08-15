<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users,phone_number,' . $this->user()->id],
            'phone_number_emergency' => ['required', 'digits:11', 'regex:/(09)[0-9]{9}/', 'unique:users,phone_number_emergency,' . $this->user],
            'email' => ['required', 'email', 'unique:users,email,' . $this->user()->id],
            'national_code' => ['required','unique:users,national_code' . $this->user()->id,'string', 'max:255'],
            'birth_date' => ['required','date', 'before:today'],
            'gender' => ['required','in:male,female'],
            'marital' => ['required', 'in:married,Single'],
            'card_number' => ['string', 'max:255'],
            'iban' => ['string', 'max:255']
        ];

        if ($this->is_first_time()) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }

    protected function is_first_time()
    {
        return Auth::user()->password === null;
    }
}
