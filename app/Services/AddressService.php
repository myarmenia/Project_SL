<?php

namespace App\Services;

class AddressService
{
    public static function store(object $modelData, array $attributes): void
    {
        $modelData->model->address()->create($attributes);
    }
}
