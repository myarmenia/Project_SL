<?php

namespace App\Services;

class ManBeanCountryService
{
    public static function store(object $man, array $attributes): void
    {
        $newData = self::createRegionOrLocality([
            'locality_id' => $attributes['locality_id'],
            'region_id' => $attributes['region_id'],
        ], $attributes);

        $man->beanCountry()->create($newData);
    }

    /**
     * @param  array  $fields
     * @param  array  $attributes
     * @return array
     */
    public static function createRegionOrLocality(array $fields, array $attributes): array
    {
        $data = [];
        foreach ($fields as $key => $value) {
            unset($attributes[$key]);
            if (isset($value)) {
                $model = str_replace("_id", "", $key);
                if (is_numeric($value) && is_int((int)$value)) {
                    $data[$key] = $value;
                } else {
                    $newModelId = app('App\Models\\'.$model)->create(['name' => $value])->id;
                    $data[$key] = $newModelId;
                }
            }
        }

        return $data + $attributes;
    }
}
