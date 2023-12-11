<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWeaponRequest extends FormRequest
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
            'attributes' => ['required_without_all:category,view,type,weapon_model,reg_num,count'],
            'category' => ['nullable'],
            'view' => ['nullable'],
            'type' => ['nullable'],
            'weapon_model' => ['nullable'],
            'reg_num' => ['nullable'],
            'count' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'attributes' =>  __('content.enter_anything')
        ];
    }
}
