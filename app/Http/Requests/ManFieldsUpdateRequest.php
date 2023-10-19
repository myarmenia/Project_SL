<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManFieldsUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'fieldName' => ['required', 'string'],
            'value' => ['required'],
            'model' => ['nullable', 'string'],
            'table' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'local' => ['nullable', 'string'],
            'intermediate' => ['nullable', 'boolean'],
        ];
    }
}
