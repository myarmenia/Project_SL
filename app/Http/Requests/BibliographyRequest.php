<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;

class BibliographyRequest extends FormRequest
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
        // dd($this); 
        $arr=[]; 
        if($this['fieldName']=='related_year'){ 
            $arr= [ 
                'value' => 'required|numeric', 
            ]; 
        } 
        if($this['fieldName']=='from_agency_id'){ 
            // dd(444); 
            $arr= [ 
                'value' => 'required|integer', 
            ]; 
        } 
        if($this['fieldName']=='category_id'){ 
 
            $arr= [ 
                'value' => 'required|integer', 
            ]; 
        } 
        if($this['fieldName']=='access_level_id'){ 
 
            $arr= [ 
                'value' => 'required|integer', 
            ]; 
        } 
        if($this['fieldName']=='source_agency_id'){ 
 
            $arr= [ 
                'value' => 'required|integer', 
            ]; 
        } 
 
 
        return $arr; 
 
 
 
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors

        throw new HttpResponseException(response()->json(['errors' => $errors]));
    }
}
