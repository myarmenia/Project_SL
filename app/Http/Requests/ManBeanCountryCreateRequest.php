<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManBeanCountryCreateRequest extends FormRequest
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
            'goal_id' => ['nullable','exists:goal,id'],
            'country_ate_id' => ['required','exists:country_ate,id'],
            'region_id' => ['nullable','string'],
            'locality_id' => ['nullable','string'],
            'entry_date' => ['nullable','date'],
            'exit_date' => ['nullable','date'],
        ];
    }

    public function messages (): array 
    {
        return [
            'country_ate_id' => __('validation.required', ['attribute' => __('content.country_ate')])
        ];
    }
}
