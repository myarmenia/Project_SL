<?php

namespace App\Services;

class ManBeanCountryService
{
    public static function store(object $modelData, array $attributes): void
    {
        $newData = self::createRegionOrLocality([
            'locality_id' => $attributes['locality_id'],
            'region_id' => $attributes['region_id'],
        ], $attributes);

        $modelData->model->beanCountry()->create($newData);
    }

    public static function update(object $manBeanCountry, array $attributes): void
    {
        $newData = self::createRegionOrLocality([
            'locality_id' => $attributes['locality_id'],
            'region_id' => $attributes['region_id'],
        ], $attributes);

        $manBeanCountry->update($newData);
    }

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
