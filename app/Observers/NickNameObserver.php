<?php

namespace App\Observers;

use App\Events\ConsistentSearchEvent;
use App\Models\ConsistentSearch;
use App\Models\NickName;

class NickNameObserver
{

    /**
     * Handle the NickName "created" event.
     *
     * @param  \App\Models\NickName  $nickName
     * @return void
     */
    public function created(NickName $nickName)
    {
        event(new ConsistentSearchEvent(ConsistentSearch::SEARCH_TYPES['MAN'], $nickName['name'], ConsistentSearch::NOTIFICATION_TYPES['INCOMING']));
    }

    /**
     * Handle the NickName "updated" event.
     *
     * @param  \App\Models\NickName  $nickName
     * @return void
     */
    public function updated(NickName $nickName)
    {
        //
    }

    /**
     * Handle the NickName "deleted" event.
     *
     * @param  \App\Models\NickName  $nickName
     * @return void
     */
    public function deleted(NickName $nickName)
    {
        //
    }

    /**
     * Handle the NickName "restored" event.
     *
     * @param  \App\Models\NickName  $nickName
     * @return void
     */
    public function restored(NickName $nickName)
    {
        //
    }

    /**
     * Handle the NickName "force deleted" event.
     *
     * @param  \App\Models\NickName  $nickName
     * @return void
     */
    public function forceDeleted(NickName $nickName)
    {
        //
    }
}
