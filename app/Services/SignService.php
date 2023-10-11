<?php

namespace App\Services;

class SignService
{
    /**
     * @param  object  $man
     * @param  array  $attributes
     * @return int
     */
    public static function store(object $man, array $attributes): int
    {
        $man->externalSign()->create($attributes);

        return $man->id;
    }
}
