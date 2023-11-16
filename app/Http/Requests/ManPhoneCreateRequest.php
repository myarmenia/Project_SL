<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManPhoneCreateRequest extends FormRequest
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
            'number' => ['required','string','min:9','max:16'],
            'character_id' => ['nullable','exists:character,id'],
            'more_data' => ['nullable']
        ];
    }
}
