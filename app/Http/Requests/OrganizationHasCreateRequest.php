<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationHasCreateRequest extends FormRequest
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
        return [
            'man_id' => ['required_without_all:organization_id','exists:man,id'],
            'organization_id' => ['required_without_all:man_id','exists:organization,id'],
            'title' => ['nullable'],
            'period' => ['nullable'],
            'start_date' => ['nullable','date'],
            'end_date' => ['nullable','date'],
        ];
    }
}
