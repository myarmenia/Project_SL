<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Man\Man;

class ManService
{
    /**
     * @return int
     */
    public function store(): int
    {
        return Man::create()->id;
    }

    public function update(object $man, array $attributes)
    {
        $newData = [$attributes['fieldName'] => $attributes['value']];
        $newModel = null;
        $table = $attributes['table'] ?? null;
        $model = $attributes['model'] ?? null;

        if ($attributes['type'] === 'location') {
            $this->updateLocationFields($man, $model, $table, $newData);
        } elseif ($attributes['type'] === 'local') {
            $man->beanCountry()->updateOrCreate(['man_id' => $man->id], [$table.'_id' => $attributes['value']]);
        } elseif ($attributes['type'] === 'create_relation') {
//            dd($model,$newData);
            $newModel = $man->$model()->create($newData);
        } elseif ($attributes['type'] === 'attach_relation') {
            $man->$table()->attach($attributes['value']);
            $newModel = app('App\Models\\'.$model)::find($attributes['value']);
        } elseif ($attributes['type'] === 'update_field') {
            $man->update($newData);
        }

        return $newModel;
    }

    public function updateLocationFields(object $man, string $model, string $field, array $newData): void
    {
        if ($man->bornAddress?->$model()->exists()) {
            $man->bornAddress->$model()->update($newData);
        } else {
            if ($man->bornAddress()->exists()) {
                $address = $man->bornAddress;
            } else {
                $address = Address::create();
            }
            $address->update([$field => $address->$model()->create($newData)->id]);
            if (!$man->bornAddress()->exists()) {
                $man->update(['born_address_id' => $address->id]);
            }
        }
    }
}
