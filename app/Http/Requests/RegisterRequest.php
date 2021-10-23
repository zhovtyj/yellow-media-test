<?php

namespace App\Http\Requests;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email'=> 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'sometimes|string|max:255',
        ];
    }
}
