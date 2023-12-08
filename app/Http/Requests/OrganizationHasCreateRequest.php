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
        $model =  request()->model === 'man' ? 'organization' : 'man';
        return [
            $model.'_id' => ['required:organization_id',"exists:$model,id"],
            'title' => ['nullable'],
            'period' => ['nullable'],
            'start_date' => ['nullable','date'],
            'end_date' => ['nullable','date'],
        ];
    }

    public function messages(): array
    {
        $model = request()->model;
        return [
            $model.'_id' => __('validation.required', ['attribute' => __("content.$model")]),
        ];
    }
}
