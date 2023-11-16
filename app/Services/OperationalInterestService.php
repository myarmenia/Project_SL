<?php

namespace App\Services;

use App\Models\ObjectsRelation;

class OperationalInterestService
{
    public static function store(int $modelId, array $attributes, string $objectTypes)
    {
        dd($objectTypes,$attributes, $modelId);
        ObjectsRelation::create(
            $attributes + [
                'first_object_id' => $modelId,
                'first_object_type' => 'man',
                'second_obejct_type' => $objectTypes,
            ]
        );
    }
}
