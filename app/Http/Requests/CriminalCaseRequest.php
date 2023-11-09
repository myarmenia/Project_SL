<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class CriminalCaseRequest extends FormRequest
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



        $arr = [
            'fieldName' => ['required'],
            'value' => ['nullable'],
            'model' => ['nullable', 'string'],
            'table' => ['nullable', 'string'],
            'type' => ['nullable', 'string']
        ];

        if($this['fieldName'] == 'number'){
            $arr['number'] = 'integer';

        }

        return $arr;
    }

    public function failedValidation(ValidationValidator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors

        throw new HttpResponseException(response()->json(['errors' => $errors]));
    }
}


