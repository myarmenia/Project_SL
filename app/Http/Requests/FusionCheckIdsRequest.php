<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB;

class FusionCheckIdsRequest extends FormRequest
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

        $arr = [
            'first_id' => ['required'],
            'second_id' => ['required']
        ];

        if(isset($this->first_id) && !$this->checkRow($this->first_id, $this->name)){
            $arr['first_id'] = ['confirmed'];
        }
        
        if(isset($this->second_id) && !$this->checkRow($this->second_id, $this->name)){
            $arr['second_id'] = ['confirmed'];
        }

        return $arr;
    }

    public function messages()

    {
        return [
            'first_id.confirmed' => $this->first_id. __('content.no_id'),
            'second_id.confirmed' => $this->second_id. __('content.no_id'),

        ];

    }


    public function checkRow($id, $name){
        return DB::table($name)->find($id);
    }
}
