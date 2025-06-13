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
            'words' => 'sometimes|string|min:1',
            'format' => 'sometimes|string|in:text,json',
            'language' => 'sometimes|string|in:et,en,de,fr',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'force.boolean' => 'The force parameter must be true or false.',
            'words.min' => 'Please provide at least one word.',
            'format.in' => 'Format must be either "text" or "json".',
            'language.in' => 'Language must be one of: et, en, de, fr.',
        ];
    }

    /**
     * Check if this is a custom word import request
     */
    public function isCustomImport(): bool
    {
        return $this->has('words') && !empty($this->input('words'));
    }

    /**
     * Check if this is a default import request
     */
    public function isDefaultImport(): bool
    {
        return !$this->isCustomImport();
    }
}
