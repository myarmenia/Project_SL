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

        $data = ['phone_id' => $phone->id];

        if ($modelData->name !== 'action') {
            $data['character_id'] = $request['character_id'];
        };

        $modelData->model->phone()->attach([$data]);
    }
}
