<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAdminRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'sometimes',
                'string',
                'min:8',
                'max:24',
                'regex:/[A-Z]/',       // Uppercase
                'regex:/[a-z]/',       // Lowercase
                'regex:/[0-9]/',       // Number
                'regex:/[@$!%*?&#]/',  // Special char
            ],
        ];
    }
}
