<?php

namespace App\Observers;

use App\Models\Man\ManHasCar;

class ManHasCarObserver
{
    /**
     * Handle the ManHasCar "created" event.
     *
     * @param  \App\Models\Man\ManHasCar  $manHasCar
     * @return void
     */
    public function created(ManHasCar $manHasCar)
    {
    }

    /**
     * Handle the ManHasCar "updated" event.
     *
     * @param  \App\Models\Man\ManHasCar  $manHasCar
     * @return void
     */
    public function updated(ManHasCar $manHasCar)
    {
        //
    }

    /**
     * Handle the ManHasCar "deleted" event.
     *
     * @param  \App\Models\Man\ManHasCar  $manHasCar
     * @return void
     */
    public function deleted(ManHasCar $manHasCar)
    {
        //
    }

    /**
     * Handle the ManHasCar "restored" event.
     *
     * @param  \App\Models\Man\ManHasCar  $manHasCar
     * @return void
     */
    public function restored(ManHasCar $manHasCar)
    {
        //
    }

    /**
     * Handle the ManHasCar "force deleted" event.
     *
     * @param  \App\Models\Man\ManHasCar  $manHasCar
     * @return void
     */
    public function forceDeleted(ManHasCar $manHasCar)
    {
        //
    }
}
