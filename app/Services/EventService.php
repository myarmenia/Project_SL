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
    public function store(): int
    {
        return ModelsEvent::create()->id;
    }

    public function update(object $event, array $attributes)
    {

        $newData = [$attributes['fieldName'] => $attributes['value']];
        $newModel = null;
        $table = $attributes['table'] ?? null;
        $model = $attributes['model'] ?? null;

        if ($attributes['type'] === 'location') {
            // ComponentService::updateBornAddressLocations($man, $table, $attributes['value'], $model);
        }
        elseif ($attributes['type'] === 'create_relation') {
            // $newModel = $man->$model()->create($newData);
        } elseif ($attributes['type'] === 'attach_relation') {
            $event->$table()->attach($attributes['value']);
            $newModel = app('App\Models\\'.$model)::find($attributes['value']);
        } elseif ($attributes['type'] === 'update_field') {
            // $man->update($newData);
        } elseif ($attributes['type'] === 'file') {
            // $newModel = json_decode(FileUploadService::saveFile($man, $attributes['value'], 'man/'.$man->id.'/answer'));
        }
        return $newModel;
    }
}
