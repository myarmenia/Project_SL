<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SignalRequest extends FormRequest
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
        $arr=[];
        if($this['fieldName']=='reg_num'){
            if($this->value!=''){
                $arr= [
                    'value' => 'required|integer',
                ];
            }
        }
        if($this['fieldName']=='check_line'){
            if($this->value!=''){
                $arr= [
                    'value' => 'required|integer',
                ];
            }
        }

        return $arr;
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors
        // dd($errors);

        throw new HttpResponseException(response()->json(['errors' => $errors]));
    }
}
