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
        } elseif ($attributes['fieldName'] === 'last_name' || $attributes['fieldName'] === 'middle_name' || $attributes['fieldName'] === 'first_name'){
            $man->full_name = $man->firstName1->pluck('first_name')->merge($man->lastName1->pluck('last_name'))->merge($man->middleName1->pluck('middle_name'))->filter()->implode(' ').' '.$attributes['value'];
            $man->save();
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
