<?php

namespace App\Services;

use App\Events\ConsistentSearchRelationsEvent;
use App\Models\Color;

class CarService
{
    public static function store(object $modelData, array $attributes): void
    {
        $attributes = self::checkColor($attributes);

        $relation = $modelData->relation;

        $newTable = $modelData->model->$relation()->create($attributes);

        event(new ConsistentSearchRelationsEvent($modelData->model->$relation()->getTable(), $newTable->id, '', $modelData->model->id));
    }

    public static function update(object $modelData, array $attributes): void
    {
        $attributes = self::checkColor($attributes);

        $modelData->update($attributes);
    }

    public static function checkColor($attributes){
        if (isset($attributes['color_id'])) {
            $color = Color::firstOrCreate(
                ['name' => $attributes['color_id']],
                ['name' => $attributes['color_id']]
            );
            $attributes['color_id'] = $color->id;
        }
        return $attributes;
    }
}
