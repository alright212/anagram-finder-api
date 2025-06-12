<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordbaseImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // No authentication required for this demo
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'force' => 'sometimes|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'force.boolean' => 'The force parameter must be true or false.',
        ];
    }
}
