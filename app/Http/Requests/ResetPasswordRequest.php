<?php

namespace App\Http\Requests;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token'=> 'required|string',
        ];
    }
}
