<?php

namespace App\Services;

use App\Events\ConsistentSearchEvent;

class EmailService
{

    /**
     * @param object $modelData
     * @param array $request
     */
    public static function store(object $modelData, array $request): void
    {
       $info = $modelData->model->email()->create(array_filter($request));
       event(new ConsistentSearchEvent($modelData->model->email()->getTable(), $info->id));
    }
}
