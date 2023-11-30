<?php

namespace App\Services;

use App\Models\CountryAte;
use App\Models\Locality;
use App\Models\Region;
use App\Models\Street;

class AddressService
{
    public static function store(object $modelData, array $attributes, $dummy): void
    {
        if (isset($attributes['region'])) {
            $attributes['region_id'] =  Region::create(['name' => $attributes['region']])->id;
        }
        if (isset($attributes['country'])) {
            $attributes['country_ate_id'] =  CountryAte::create(['name' => $attributes['country']])->id;
        }
        if (isset($attributes['locality'])) {
            $attributes['locality_id'] =  Locality::create(['name' => $attributes['locality']])->id;
        }
        if (isset($attributes['street'])) {
            $attributes['street_id'] =  Street::create(['name' => $attributes['street']])->id;
        }

       $model = $modelData->model->address()->create($attributes);

       if ($dummy){
           $modelData->model->update(['address_id' => $model->id]);
       }
    }

    public static function update(object $address, array $attributes): void
    {
        $address->update($attributes);
    }
}
