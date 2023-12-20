<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManExternalSignPhotoCreateRequest extends FormRequest
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
            'fixed_date' => ['nullable'],
            'image' => ['required','image','mimes:jpeg,jpg,png,gif','max:64'],
        ];
    }

    public function messages (): array
    {
        return [
            'image' => __('validation.required', ['attribute' => __('content.upload')])
        ];
    }
}
