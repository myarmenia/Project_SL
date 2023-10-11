<?php

namespace App\Services;

class EmailService
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
            'email',
            ['address' => $request['address']],
            ['character_id' => $request['character_id']]
        );
    }
}
