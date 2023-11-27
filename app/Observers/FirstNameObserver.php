<?php

namespace App\Observers;

use App\Events\ConsistentSearchEvent;
use App\Models\ConsistentSearch;
use App\Models\FirstName;

class FirstNameObserver
{

    const FIELD = 'man';

    /**
     * Handle the FirstName "created" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function created(FirstName $firstName)
    {
        event(new ConsistentSearchEvent(ConsistentSearch::SEARCH_TYPES['MAN'], $firstName['first_name'], ConsistentSearch::NOTIFICATION_TYPES['INCOMING']));
    }

    /**
     * Handle the FirstName "updated" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function updated(FirstName $firstName)
    {
        //
    }

    /**
     * Handle the FirstName "deleted" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function deleted(FirstName $firstName)
    {
        //
    }

    /**
     * Handle the FirstName "restored" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function restored(FirstName $firstName)
    {
        //
    }

    /**
     * Handle the FirstName "force deleted" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function forceDeleted(FirstName $firstName)
    {
        //
    }
}
