<?php

namespace App\Services;

use App\Events\ConsistentSearchWithRelationEvent;
use App\Models\ConsistentSearch;
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
        $phone = Phone::create($request);
        $data = ['phone_id' => $phone->id];

        if ($modelData->name !== 'action') {
            $data['character_id'] = $request['character_id'];
        };
        $modelData->model->phone()->attach([$data]);
        event(new ConsistentSearchWithRelationEvent($modelData->model->phone()->getTable(), $phone->id, ConsistentSearch::NOTIFICATION_TYPES['INCOMING']));
    }
}
