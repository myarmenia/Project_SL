<?php

namespace App\Services;

use App\Models\Color;

class CarService
{
    public static function store(object $modelData, array $attributes): void
    {
        $attributes = self::checkColor($attributes);

        $relation = $modelData->relation;

        $modelData->model->$relation()->create($attributes);
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
