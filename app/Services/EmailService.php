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
        $man->email()->create(array_filter($request));
    }
}
