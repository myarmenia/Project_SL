<?php

namespace App\Services;

use App\Models\Weapon;

class WeaponService
{
    public static function store(object $modelData, $attributes): void
    {
        $relation = $modelData->relation;

        if (isset($attributes['weapon_model'])){
            $attributes['model'] = $attributes['weapon_model'];
        }
        unset( $attributes['weapon_model']);

        $modelData->model->$relation()->create($attributes);
    }

    public static function update(object $weapon, array $attributes): void
    {
        $weapon->update($attributes);
    }
}
