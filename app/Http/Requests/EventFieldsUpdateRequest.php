<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class EventFieldsUpdateRequest extends FormRequest
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

        $id = $this->route('event')->id;
        $event = Event::find($id);
        $date = $event->date;
        $event_qualification = $event->event_qualification;
        // dd($this);
// $arr = [];
        // $arr=[
        //     'fieldName' => ['required'],
        //     'value' => ['required'],
        //     'model' => ['nullable', 'string'],
        //     'table' => ['nullable', 'string'],
        //     'type' => ['nullable', 'string']
        // ];

        if($this['fieldName'] == 'time' && $date == null){
// dd(111);
            $arr= [
                'event-date' => 'required',
            ];
        }

        if($event_qualification->count() == 0){

            $arr= [
                'qualification_id' => ['required'],
            ];
        }

        $arr=[
            'fieldName' => ['nullable'],
            'value' => ['required'],
            'model' => ['nullable', 'string'],
            'table' => ['nullable', 'string'],
            'type' => ['nullable', 'string']
        ];

        return $arr;
    }

    public function failedValidation(ValidationValidator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors

        throw new HttpResponseException(response()->json(['errors' => $errors]));
    }
}

