<?php

namespace App\Services;

class PhoneService
{
    /**
     * @param  object  $man
     * @param  array  $request
     * @return void
     */
    public static function store(object $man, array $request): void
    {
        ComponentService::storeInsertRelations(
            $man,
            'phone',
            ['number' => $request['number'], 'more_data' => $request['more_data']],
            ['character_id' => $request['character_id']]
        );
    }
}
