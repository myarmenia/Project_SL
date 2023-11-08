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

        // dd($attributes);
        // dd($newData);
        $newModel = null;
        $table = $attributes['table'] ?? null;
        $model = $attributes['model'] ?? null;
        $value = $attributes['value'] ?? null;
        $field_name = $attributes['fieldName'] ?? null;

        if($field_name == 'date'){
            $value = $event->date != null ? $attributes['value'] .' '. date('H:i', strtotime($event->date)) : $attributes['value'] .' 00:00:00';
        }
        else{
            $value = $event->date != null ? date('Y-m-d', strtotime($event->date)). ' '. $attributes['value'] : null;
            $field_name = 'date';
        }

        $newData = [$field_name => $value];


        return ComponentService::update($event, $attributes);
        // if ($attributes['type'] === 'location') {
        //     // ComponentService::updateBornAddressLocations($man, $table, $attributes['value'], $model);
        // }
        // elseif ($attributes['type'] === 'create_relation') {
        //     // $newModel = $man->$model()->create($newData);
        // } elseif ($attributes['type'] === 'attach_relation') {
        //     $event->$table()->attach($attributes['value']);
        //     $newModel = app('App\Models\\'.$model)::find($attributes['value']);
        // } elseif ($attributes['type'] === 'update_field') {
        //     $event->update($newData);
        // } elseif ($attributes['type'] === 'file') {
        //     // $newModel = json_decode(FileUploadService::saveFile($man, $attributes['value'], 'man/'.$man->id.'/answer'));
        // }
        // return $newModel;
    }
}
