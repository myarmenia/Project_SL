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
        if ($modelData->name === 'organization'){
            $attributes['organization_id'] = $modelData->id;
        }

        $modelData->model->organization_has_man()->create(array_filter($attributes));
    }
}
