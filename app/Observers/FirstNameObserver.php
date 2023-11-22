<?php

namespace App\Observers;

use App\Models\FirstName;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Support\Facades\Auth;

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
        ConsistentSearchService::search(self::FIELD, $firstName['first_name']);
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
