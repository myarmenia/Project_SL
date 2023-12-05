<?php

namespace App\Services;

use App\Models\ObjectsRelation;

class OperationalInterestService
{
    public static function store(int $modelId, array $attributes, string $objectTypes)
    {
        ObjectsRelation::create(
            $attributes + [
                'first_object_id' => $modelId,
                'first_object_type' => $objectTypes,
                'second_obejct_type' =>  $objectTypes,
            ]
        );
    }

    public static function update(object $objectRelation, array $attributes): void
    {
        $objectRelation->update($attributes);
    }
}
