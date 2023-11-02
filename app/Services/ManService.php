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
            $this->updateBornAddressLocations($man, $table, $attributes['value'], $model);
        } elseif ($attributes['type'] === 'create_relation') {
            $newModel = $man->$model()->create($newData);
        } elseif ($attributes['type'] === 'attach_relation') {
            $man->$table()->attach($attributes['value']);
            $newModel = app('App\Models\\'.$model)::find($attributes['value']);
        } elseif ($attributes['type'] === 'update_field') {
            $man->update($newData);
        } elseif ($attributes['type'] === 'file') {
            $newModel = json_decode(FileUploadService::saveFile($man, $attributes['value'], 'man/'.$man->id.'/answer'));
        }

        return $newModel;
    }

    public function updateBornAddressLocations(object $man, string $table, string $value, string $model): void
    {
        if ($man->bornAddress()->exists()) {
            $address = $man->bornAddress;
        } else {
            $address = Address::create();
        }

        if (is_numeric($value) && is_int((int)$value)) {
            $data = [$table.'_id' => $value];
        } else {
            $data = app('App\Models\\'.$model)->create(['name' => $value]);
            $data = [$table => $data->id];
        }

        $address->update($data);
        if (!$man->bornAddress()->exists()) {
            $man->update(['born_address_id' => $address->id]);
        }
    }
}
