<?php

namespace App\Services;

use App\Models\Phone;

class PhoneService
{
    /**
     * @param  object  $modelData
     * @param  array  $request
     * @return void
     */
    public static function store(object $modelData, array $request): void
    {
//        dd( $modelData->model->phone()->getTable(), $request['number'] );
        $phone = Phone::create($request);

        $modelData->model->phone()->attach([['character_id' => $request['character_id'], 'phone_id' => $phone->id]]);
    }
}
