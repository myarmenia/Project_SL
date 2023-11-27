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
    public function rules()
    {
        $arr = [];
        $data = $this->all();

        $filter_array = array_filter($data, function ($value) {
            return $value === null;
        });

        if (count($filter_array) == count($data)) {
            $arr[key($filter_array)] = 'required';
        }

        return $arr;
    }

    public function messages()
    {
        return [
            'category_id' => 'partadira',
        ];
    }
}
