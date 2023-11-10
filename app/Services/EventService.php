<?php

namespace App\Services;

use App\Models\Event as ModelsEvent;

class EventService
{
    /**
     * @param  object  $man
     * @param  array  $request
     * @return void
     */
    public function store($bibliography_id): int
    {
        return ModelsEvent::create(['bibliography_id'=>$bibliography_id])->id;
    }

    public function update(object $event, array $attributes)
    {

        $value = $attributes['value'] ?? null;
        $field_name = $attributes['fieldName'] ?? null;

        if($field_name == 'date'){
            $value = $event->date != null ? $attributes['value'] .' '. date('H:i', strtotime($event->date)) : $attributes['value'] .' 00:00:00';
        }
        else{
            $value = $event->date != null ? date('Y-m-d', strtotime($event->date)). ' '. $attributes['value'] : null;
            $field_name = 'date';
        }

        $attributes['fieldName'] = $field_name;
        $attributes['value'] = $value;

        return ComponentService::update($event, $attributes);

    }
}
