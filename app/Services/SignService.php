<?php

namespace App\Services;

class SignService
{
    /**
     * @param  object  $man
     * @param  array  $attributes
     * @return void
     */
    public static function store(object $man, array $attributes): void
    {
        $man->externalSign()->create($attributes);
    }
}
