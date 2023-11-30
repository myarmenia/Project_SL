<?php

namespace App\Services;

use App\Events\ConsistentSearchWithRelationEvent;
use App\Models\ConsistentSearch;

class EmailService
{


    /**
     * @param object $modelData
     * @param array $request
     */
    public static function store(object $modelData, array $request): void
    {
       $info = $modelData->model->email()->create(array_filter($request));
       event(new ConsistentSearchWithRelationEvent($modelData->model->email()->getTable(), $info->id, ConsistentSearch::NOTIFICATION_TYPES['INCOMING']));
    }
    public static function update(object $email, array $attributes, $modelData = null): void
    {
        
        $email->update($attributes);
    }
}
