<?php

namespace App\Services;

class BlurInputService
{
    /**
     * @param  object  $man
     * @param  array  $attributes
     * @return mixed
     */
    public static function store(object $man, array $attributes): int
    {
        if ($attributes['data']['intermediate']) {
            $newData = [$attributes['data']['field'] => $attributes['data']['value']];
            $firstTable = $attributes['data']['table'];

            $man->belongsToManyRelation($firstTable)->create($newData);
        } else {
            $newData = [$attributes['data']['table'] => $attributes['data']['value']];

            $man->update($newData);
        }

        return $man->id;
    }
}