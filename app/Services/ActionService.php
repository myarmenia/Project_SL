<?php

namespace App\Services;

use App\Models\Action;
use App\Services\Log\LogService;
use App\Traits\HelpersTraits;

class ActionService
{
    /**
     * @param  int  $id
     * @return Action
     */
    public function store(int $id): Action
    {
        return Action::create(['bibliography_id' => $id]);
    }

    /**
     * @param  object  $action
     * @param  array  $attributes
     * @return mixed|null
     */
    public function update(object $action, array $attributes): mixed
    {
        if ($attributes['type'] === 'update_time'){
            if ($attributes['fieldName'] === 'start_time'){
                $updated_fields = $action->start_date !== null ? HelpersTraits::getDateTimeFormat($action->start_date). ' '. $attributes['value'] : null;
                $action->update(['start_date' => $updated_fields]) ;
            }else{
                $updated_fields = $action->end_date !== null ? HelpersTraits::getDateTimeFormat($action->end_date). ' '. $attributes['value'] : null;
                $action->update(['end_date' => $updated_fields]) ;
            }
            LogService::store([$updated_fields], $action->id, $action->getTable(), 'update');
        }

        if ($attributes['type'] === 'date') {
            $action[$attributes['fieldName']] = $attributes['value'] != null ? $attributes['value'] .' '. HelpersTraits::getTimeFormat($action[$attributes['fieldName']]) : $attributes['value'] .' 00:00:00';
            $action->save();
        }

        return ComponentService::update($action, $attributes);
    }
}
