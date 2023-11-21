<?php

namespace App\Observers;

use App\Models\Signal;
use App\Services\Log\LogService;
use Illuminate\Http\Request;

class SignalObserver
{
    /**
     * Handle the Signal "created" event.
     *
     * @param  \App\Models\Signal  $signal
     * @return void
     */
    public function created(Signal $signal)
    {
        //
    }

    /**
     * Handle the Signal "updated" event.
     *
     * @param  \App\Models\Signal  $signal
     * @return void
     */
    public function updated(Request $request,Signal $signal)
    {
// dd($signal);
        //  $log = LogService::store($signal->toArray(), $signal->id, 'signal', 'edit');
    }


    /**
     * Handle the Signal "deleted" event.
     *
     * @param  \App\Models\Signal  $signal
     * @return void
     */
    public function deleted(Signal $signal)
    {
        //
    }

    /**
     * Handle the Signal "restored" event.
     *
     * @param  \App\Models\Signal  $signal
     * @return void
     */
    public function restored(Signal $signal)
    {
        //
    }

    /**
     * Handle the Signal "force deleted" event.
     *
     * @param  \App\Models\Signal  $signal
     * @return void
     */
    public function forceDeleted(Signal $signal)
    {
        //
    }
}
