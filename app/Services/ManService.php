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

        if (isset($attributes['intermediate'])) {
            $model = $attributes['model'];

            if (isset($attributes['location'])){
                 $this->updateLocationFields($man, $model, $attributes['table'],$newData);
            }else{
                if (method_exists($man, $model)) {
                    $newModel = $man->$model()->create($newData);
                } else {
                    $newModel = $man->belongsToManyRelation($model, $attributes['table'] ?? $attributes['fieldName'])->create($newData);
                }
            }
        } else {
            $man->update($newData);
        }

        return $newModel;
    }

    public function updateLocationFields(object $man, string $model,string $field, array $newData): void
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
