<?php

namespace App\Observers;

use App\Events\ConsistentSearchEvent;
use App\Models\ConsistentSearch;
use App\Models\LastName;

class LastNameObserver
{

    /**
     * Handle the LastName "created" event.
     *
     * @param  \App\Models\LastName  $lastName
     * @return void
     */
    public function created(LastName $lastName)
    {
        event(new ConsistentSearchEvent(ConsistentSearch::SEARCH_TYPES['MAN'], $lastName['last_name'], ConsistentSearch::NOTIFICATION_TYPES['INCOMING']));
    }

    /**
     * Handle the LastName "updated" event.
     *
     * @param  \App\Models\LastName  $lastName
     * @return void
     */
    public function updated(LastName $lastName)
    {
        //
    }

    /**
     * Handle the LastName "deleted" event.
     *
     * @param  \App\Models\LastName  $lastName
     * @return void
     */
    public function deleted(LastName $lastName)
    {
        //
    }

    /**
     * Handle the LastName "restored" event.
     *
     * @param  \App\Models\LastName  $lastName
     * @return void
     */
    public function restored(LastName $lastName)
    {
        //
    }

    /**
     * Handle the LastName "force deleted" event.
     *
     * @param  \App\Models\LastName  $lastName
     * @return void
     */
    public function forceDeleted(LastName $lastName)
    {
        //
    }
}
