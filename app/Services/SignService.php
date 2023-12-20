<?php

namespace App\Services;

use App\Traits\HelpersTraits;

class SignService
{
    /**
     * @param  object  $modelData
     * @param  array  $attributes
     * @return void
     */
    public static function store(object $modelData, array $attributes): void
    {
        $modelData->model->man_external_sign_has_sign()->create($attributes);
    }

    public static function update(object $manExternalSignHasSign, array $attributes): void
    {
       if ($attributes['fixed_date']){
           $attributes['fixed_date'] = HelpersTraits::getDateTimeFormat($attributes['fixed_date'],true);
       }

        $manExternalSignHasSign->update($attributes);
    }
}
