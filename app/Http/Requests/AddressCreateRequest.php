<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressCreateRequest extends FormRequest
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
        return [
            'attributes' => ['required_without_all:country_ate_id,region_id,locality_id,street_id,region,locality,street,track,home_num,housting_num,apt_num'],
            'country_ate_id' => ['nullable','exists:country_ate,id'],
            'region_id' => ['nullable','exists:region,id'],
            'locality_id' => ['nullable','exists:locality,id'],
            'street_id' => ['nullable','exists:street,id'],
            'region' => ['nullable','string'],
            'locality' => ['nullable','string'],
            'street' => ['nullable','string'],
            'track' => ['nullable','string'],
            'home_num' => ['nullable','string'],
            'housing_num' => ['nullable','string'],
            'apt_num' => ['nullable','string'],
        ];
    }
}
