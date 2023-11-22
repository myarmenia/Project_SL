<?php

namespace App\Observers;

use App\Models\NickName;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Support\Facades\Auth;

class NickNameObserver
{

    const FIELD = 'man';

    /**
     * Handle the NickName "created" event.
     *
     * @param  \App\Models\NickName  $nickName
     * @return void
     */
    public function created(NickName $nickName)
    {
        ConsistentSearchService::search(self::FIELD, $nickName['name']);
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
