<?php

namespace App\Services;

use App\Models\Action;
use App\Models\Man\Man;
use Carbon\Carbon;

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
                $action->update(['start_date' =>date('Y-m-d', strtotime($action->start_date)). ' '. $attributes['value'] ]) ;
            }else{
                $action->update(['end_date' =>date('Y-m-d', strtotime($action->end_date)). ' '. $attributes['value'] ]) ;
            }
        }

        if ($attributes['type'] === 'date') {
            $carbonDateTime = Carbon::parse($attributes['value']);
            $newCarbonDate = Carbon::parse($carbonDateTime);
            $dateTime = $carbonDateTime->setDate($newCarbonDate->year, $newCarbonDate->month, $newCarbonDate->day);
            $carbonDateTime->format('Y-m-d');

            if ($action[$attributes['fieldName']]){
                $action[$attributes['fieldName']] = $dateTime->setTimeFrom(Carbon::parse($action[$attributes['fieldName']])->format('H:i:s'));

            }else{
                $action[$attributes['fieldName']] = $dateTime->setTimeFrom(Carbon::parse('00:00:00')->format('H:i:s'));

            }
            $action->save();
        }

        return ComponentService::update($action, $attributes);
    }
}
