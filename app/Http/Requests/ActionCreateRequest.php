<?php

namespace App\Http\Requests;

use App\Models\Action;
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
    public function rules(): array
    {
        $action = $this->route('action');
        $start_date = $action->start_date;
        $end_date = $action->end_date;

        $arr = [
            'fieldName' => ['required'],
            'value' => ['nullable'],
            'model' => ['nullable'],
            'type' => ['nullable', 'string'],
        ];

        if ($this['fieldName'] === 'start_time' && $start_date === null) {
            $arr['start_action_date'] = ['required'];
        }
        elseif ($this['fieldName'] === 'end_time' && $end_date === null)  {
            $arr['end_action_date'] = ['required'];
        }

        return $arr;
    }
}
