<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'number' => ['required','string','min:9'],
            'character_id' => ['nullable','exists:character,id'],
            'more_data' => ['nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'number' => __('validation.required',['attribute' => __('content.phone_number')]).' '.__('content.error_phone'),
        ];
    }
}
