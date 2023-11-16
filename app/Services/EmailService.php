<?php

namespace App\Services;

class EmailService
{
    /**
     * @param  object  $modelData
     * @param  array  $request
     * @return void
     */
    public static function store(object $modelData, array $request): void
    {
        $modelData->model->email()->create(array_filter($request));
    }
}
