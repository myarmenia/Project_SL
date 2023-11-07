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
        if ($attributes['type'] === 'location') {
            $this->updateBornAddressLocations($man, $attributes['table'], $attributes['value'], $attributes['model']);
        }

        return ComponentService::update($man, $attributes);
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
