<?php

namespace App\Services;

class OrganizationHasManService
{
    /**
     * @param  object  $man
     * @param  array  $attributes
     * @return void
     */
    public static function store(object $man, array $attributes): void
    {
        $man->organization_has_man()->create(array_filter($attributes));
    }
}
