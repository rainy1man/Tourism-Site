<?php

namespace App\Http\Requests\Score;

use Illuminate\Foundation\Http\FormRequest;

class CreateScoreRequest extends FormRequest
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
            'tourip_id' => ['required', 'exists:tours,id'],
            'score' => ['required', 'numeric']
        ];
    }
    public function attributes(): array
    {
        return [
        //
        ];
    }
}
