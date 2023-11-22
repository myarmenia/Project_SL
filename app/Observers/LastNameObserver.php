<?php

namespace App\Observers;

use App\Models\LastName;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Support\Facades\Auth;

class LastNameObserver
{

    const FIELD = 'man';

    /**
     * Handle the LastName "created" event.
     *
     * @param  \App\Models\LastName  $lastName
     * @return void
     */
    public function created(LastName $lastName)
    {
        ConsistentSearchService::search(self::FIELD, $lastName['last_name']);
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
