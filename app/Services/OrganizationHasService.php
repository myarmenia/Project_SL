<?php

namespace App\Services;

class OrganizationHasService
{
    /**
     * @param  object  $modelData
     * @param  array  $attributes
     * @return void
     */
    public static function store(object $modelData, array $attributes): void
    {
        $modelData->model->organization_has_man()->create(array_filter($attributes));
    }

    public static function update(object $organizationHasMan, array $attributes): void
    {
        $organizationHasMan->update($attributes);
    }
}
