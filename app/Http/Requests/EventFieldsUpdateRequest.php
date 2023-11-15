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

        $arr = [
            'fieldName' => ['required'],
            'value' => ['nullable'],
            'model' => ['nullable', 'string'],
            'table' => ['nullable', 'string'],
            'type' => ['nullable', 'string']
        ];

        if($this['fieldName'] == 'time' && ($date == null || $date == '0000-00-00 00:00:00')){
            $arr['event-date'] = 'required';
        }

        if(($this['fieldName'] != 'qualification_id' ||
           ($this['fieldName'] == 'qualification_id' && $this['value'] == ''))
           && $event_qualification->count() == 0){

            $arr['qualification_id'] = 'required';
        }

        return $arr;
    }

    public function failedValidation(ValidationValidator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors

        throw new HttpResponseException(response()->json(['errors' => $errors]));
    }
}

