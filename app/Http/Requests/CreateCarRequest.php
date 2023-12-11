<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'attributes' => ['required_without_all:category_id,mark_id,color_id,number,count,note'],
            'category_id' => ['nullable','exists:car_category,id'],
            'mark_id' => ['nullable','exists:car_mark,id'],
            'color_id' => ['nullable'],
            'number' => ['nullable'],
            'count' => ['nullable'],
            'note' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'attributes' =>  __('content.enter_anything')
        ];
    }
}
