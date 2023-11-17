<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;

class ActionCreateRequest extends FormRequest
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
        $action = Event::find($this->route('action')->id);

        $start_date = $action->start_date;
        $end_date = $action->end_date;

        $arr = [
            'fieldName' => ['required'],
            'value' => ['nullable'],
            'type' => ['nullable', 'string'],
        ];

        if ($this['fieldName'] === 'start_time' && ($start_date === null || $start_date === '0000-00-00 00:00:00')) {
            $arr['start-action-date'] = 'required';
        }
        elseif ($this['fieldName'] === 'end_time' && ($end_date === null || $end_date === '0000-00-00 00:00:00')) {
            $arr['end-action-date'] = 'required';
        }

        return $arr;
    }
}
