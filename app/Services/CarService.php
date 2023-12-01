<?php

namespace App\Services;

class CarService
{
    public static function store(object $model, array $attributes): void
    {
        dd($model,$attributes);
        $model->car()->crete($attributes);
    }
}
