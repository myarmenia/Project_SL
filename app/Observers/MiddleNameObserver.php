<?php

namespace App\Observers;

use App\Events\ConsistentSearchEvent;
use App\Models\ConsistentSearch;
use App\Models\MiddleName;

class MiddleNameObserver
{

    /**
     * Handle the MiddleName "created" event.
     *
     * @param  \App\Models\MiddleName  $middleName
     * @return void
     */
    public function created(MiddleName $middleName)
    {
        event(new ConsistentSearchEvent(ConsistentSearch::SEARCH_TYPES['MAN'], $middleName['middle_name'], ConsistentSearch::NOTIFICATION_TYPES['INCOMING']));
    }

    /**
     * Handle the MiddleName "updated" event.
     *
     * @param  \App\Models\MiddleName  $middleName
     * @return void
     */
    public function updated(MiddleName $middleName)
    {
        //
    }

    /**
     * Handle the MiddleName "deleted" event.
     *
     * @param  \App\Models\MiddleName  $middleName
     * @return void
     */
    public function deleted(MiddleName $middleName)
    {
        //
    }

    /**
     * Handle the MiddleName "restored" event.
     *
     * @param  \App\Models\MiddleName  $middleName
     * @return void
     */
    public function restored(MiddleName $middleName)
    {
        //
    }

    /**
     * Handle the MiddleName "force deleted" event.
     *
     * @param  \App\Models\MiddleName  $middleName
     * @return void
     */
    public function forceDeleted(MiddleName $middleName)
    {
        //
    }
}
