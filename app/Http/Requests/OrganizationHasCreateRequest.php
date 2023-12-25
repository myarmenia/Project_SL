<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationHasCreateRequest extends FormRequest
{
    protected $modelId;

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
    public function rules(): array
    {
        $data = [
            'title' => ['nullable'],
            'period' => ['nullable'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
        ];

        if ($this->_method === 'POST'){
            $model =  request()->model === 'man' ? 'organization' : 'man';
            $data[$model.'_id'] = ['required',"exists:$model,id"];
        }

        return $data;
    }

    public function messages(): array
    {
        $model = request()->model;
        return [
            $model.'_id' => __('validation.required_with', ['attribute' => __("content.$model")]),
        ];
    }
}
