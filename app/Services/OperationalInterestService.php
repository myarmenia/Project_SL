<?php

namespace App\Services;

use App\Models\ObjectsRelation;

class OperationalInterestService
{
    public static function store(int $manId, array $attributes, string $objectTypes)
    {
        ObjectsRelation::create(
            $attributes + [
                'first_object_id' => $manId,
                'first_object_type' => 'man',
                'second_obejct_type' => $objectTypes,
            ]
        );
    }
}
