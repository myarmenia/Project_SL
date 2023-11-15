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
            'man_id' => ['nullable','exists:man,id'],
            'organization_id' => ['nullable','exists:organization,id'],
            'title' => ['nullable'],
            'period' => ['nullable'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
        ];
    }
}
