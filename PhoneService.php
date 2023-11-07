<?php

namespace App\Services;

use App\Models\Phone;

class PhoneService
{
    /**
     * @param  object  $man
     * @param  array  $request
     * @return void
     */
    public static function store(object $man, array $request): void
    {
        $phone = Phone::create($request);

        $man->phone()->attach([['character_id' => $request['character_id'], 'phone_id' => $phone->id]]);
    }
}
