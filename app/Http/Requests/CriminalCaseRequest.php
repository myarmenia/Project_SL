<?php
namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
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

            'delete_relation' => ['nullable'],
            'fieldName' => ['required'],
            'value' => ['nullable'],
            'model' => ['nullable', 'string'],
            'table' => ['nullable', 'string'],
            'type' => ['nullable', 'string']

        ];
        if ($this['fieldName'] === 'number') {

                $arr['value'] = 'integer';
            }

            return $arr;
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors

        throw new HttpResponseException(response()->json(['errors' => $errors]));
        // throw new HttpResponseException(response()->json([
        //     'success'   => false,
        //     'message'   => 'Validation errors',
        //     'data'      => $validator->errors()
        // ]));
    }


    // public function messages()

    // {
    //     return [
    //         'value.integer' => 'Title is 888'
    //     ];

    // }

}
