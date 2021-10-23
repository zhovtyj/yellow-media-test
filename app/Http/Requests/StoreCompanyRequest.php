<?php

namespace App\Http\Requests;

class StoreCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'phone' => 'required|string|max:255',
            'description' => 'sometimes|string',
        ];
    }
}
