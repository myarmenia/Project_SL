<?php

namespace App\Services;

use App\Models\Event as ModelsEvent;
use App\Traits\HelpersTraits;

class EventService
{
    /**
     * @param $bibliography_id
     * @return int
     */
    public function store($bibliography_id): int
    {
        return ModelsEvent::create(['bibliography_id'=>$bibliography_id])->id;
    }

    public function update(object $event, array $attributes)
    {

        $value = $attributes['value'] ?? null;
        $field_name = $attributes['fieldName'] ?? null;

        if($field_name === 'date'){
            $value = $attributes['value'] !== null ?  HelpersTraits::getDateTimeFormat($attributes['value']) .' '. HelpersTraits::getTimeFormat($event[$attributes['fieldName']]) : $attributes['value'] .' 00:00:00';
        }

        if($field_name === 'time'){
            $value = $event->date !== null ? HelpersTraits::getDateTimeFormat($event->date). ' '. $attributes['value'] : null;
            $field_name = 'date';
        }

        $attributes['fieldName'] = $field_name;
        $attributes['value'] = $value;

        return ComponentService::update($event, $attributes);

    }
}
