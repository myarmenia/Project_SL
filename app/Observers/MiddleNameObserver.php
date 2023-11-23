<?php

namespace App\Observers;

use App\Models\MiddleName;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Support\Facades\Auth;

class MiddleNameObserver
{

    const FIELD = 'man';

    /**
     * Handle the MiddleName "created" event.
     *
     * @param  \App\Models\MiddleName  $middleName
     * @return void
     */
    public function created(MiddleName $middleName)
    {
        ConsistentSearchService::search(self::FIELD, $middleName['middle_name']);
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
