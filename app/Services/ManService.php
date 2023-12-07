<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Man\Man;
use App\Services\Log\LogService;
use Carbon\Carbon;

class ManService
{
    /**
     * @return int
     */
    public function store(): int
    {
        $man =  Man::create();

        if (request()->model === 'bibliography'){
            $man->bibliography()->attach(request()->id);
        }
        if (str_contains(url()->previous(), 'man?main_route')) {
            $parts = parse_url(url()->previous(), PHP_URL_QUERY);
            parse_str($parts, $query_params);
            $id = $query_params['model_id'];
            $rel_man = Man::find($id);
            $rel_man->man_to_man()->attach($man->id);
        }

        if (str_contains(url()->previous(), 'man?route_name')) {
            // $parts = parse_url(url()->previous(), PHP_URL_QUERY);
            // parse_str($parts, $query_params);
            // $id = $query_params['model_id'];
            // $rel_man = Man::find($id);
            // $rel_man->first_object_relation_man()->attach($man->id);
        }
        return $man->id;
    }

    public function update(object $man, array $attributes)
    {
        if ($attributes['type'] === 'location') {
            $this->updateBornAddressLocations($man, $attributes['table'], $attributes['value'], $attributes['model']);
        } elseif ($attributes['fieldName'] === 'last_name' || $attributes['fieldName'] === 'middle_name' || $attributes['fieldName'] === 'first_name'){
            $man->full_name = $man->firstName1->pluck('first_name')->merge($man->lastName1->pluck('last_name'))->merge($man->middleName1->pluck('middle_name'))->filter()->implode(' ').' '.$attributes['value'];
            $man->save();
        } elseif ($attributes['fieldName'] === 'birthday'){
            $date = Carbon::createFromFormat('Y-m-d', $attributes['value']);
            $man->update(['birthday' => $attributes['value'],'birth_day' => $date->day,'birth_month' => $date->month,'birth_year' => $date->year,'birthday_str']);
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
