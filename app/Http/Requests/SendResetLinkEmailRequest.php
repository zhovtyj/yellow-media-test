<?php

namespace App\Http\Requests;

class SendResetLinkEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'=> 'required|email',
        ];
    }
}
