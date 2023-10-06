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
        $man->hasManyRelation('OrganizationHasMan')->create($attributes);
    }
}
