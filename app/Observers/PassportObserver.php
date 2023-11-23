<?php

namespace App\Observers;

use App\Models\Passport;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Support\Facades\Auth;

class PassportObserver
{

    const FIELD = 'man';

    /**
     * Handle the Passport "created" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function created(Passport $passport)
    {
        ConsistentSearchService::search(self::FIELD, $passport['number']);
    }

    /**
     * Handle the Passport "updated" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function updated(Passport $passport)
    {
        //
    }

    /**
     * Handle the Passport "deleted" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function deleted(Passport $passport)
    {
        //
    }

    /**
     * Handle the Passport "restored" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function restored(Passport $passport)
    {
        //
    }

    /**
     * Handle the Passport "force deleted" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function forceDeleted(Passport $passport)
    {
        //
    }
}
