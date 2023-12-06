<?php

namespace App\Services;

use App\Events\ConsistentSearchRelationsEvent;

class EmailService
{


    /**
     * @param object $modelData
     * @param array $request
     */
    public static function store(object $modelData, array $request): void
    {
       $info = $modelData->model->email()->create(array_filter($request));
       event(new ConsistentSearchRelationsEvent($modelData->model->email()->getTable(), $info->id, $info->address, $modelData->model->id));
    }
    public static function update(object $email, array $attributes, $modelData = null): void
    {
        $email->update($attributes);
    }
}
