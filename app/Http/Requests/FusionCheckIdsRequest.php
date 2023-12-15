<?php

namespace App\Http\Requests;

use App\Services\Relation\ModelRelationService;
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

        $model = ModelRelationService::get_model_class($this->name);


        if(isset($this->first_id)){
            $first_item =  $model->find($this->first_id);

            if(!$this->checkRow($this->first_id, $this->name) || $first_item == null){
                $arr['first_id'] = ['confirmed'];
            }
        }

        if(isset($this->second_id)){
            $second_item =  $model->find($this->second_id);

            if(!$this->checkRow($this->second_id, $this->name) || $second_item == null){
                $arr['second_id'] = ['confirmed'];
            }
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
