<?php

namespace App\Observers;


use App\Models\Bibliography\Bibliography;

class BibliographyObserver
{
    /**
     * Handle the Bibliography "created" event.
     *
     * @param  \App\Models\Bibliography  $bibliography
     * @return void
     */
    public function created(Bibliography $bibliography)
    {
        //
    }

    /**
     * Handle the Bibliography "updated" event.
     *
     * @param  \App\Models\Bibliography  $bibliography
     * @return void
     */
    public function updated(Bibliography $bibliography)
    {
       
    }

    /**
     * Handle the Bibliography "deleted" event.
     *
     * @param  \App\Models\Bibliography  $bibliography
     * @return void
     */
    public function deleted(Bibliography $bibliography)
    {
        //
    }

    /**
     * Handle the Bibliography "restored" event.
     *
     * @param  \App\Models\Bibliography  $bibliography
     * @return void
     */
    public function restored(Bibliography $bibliography)
    {
        //
    }

    /**
     * Handle the Bibliography "force deleted" event.
     *
     * @param  \App\Models\Bibliography  $bibliography
     * @return void
     */
    public function forceDeleted(Bibliography $bibliography)
    {
        //
    }
}
