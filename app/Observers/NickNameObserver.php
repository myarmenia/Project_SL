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
        $info = ConsistentSearchService::getConsistentSearches( self::FIELD);
        $find = [];
        if(count( $info ) > 0) {
            foreach ($info  as $value) {
                $get = false;
                $haystack = array_flip(explode(' ', strtolower($value['search_text'])));
                $needles = explode(' ', strtolower($nickName['name']));
                foreach ($needles as $needle) {
                    if (isset($haystack[$needle])) {
                        $get = true;
                    }
                }
                if($get === true) {
                    $find[]=$value;
                }
            }
        }
        if(count( $find ) > 0) {
            ConsistentSearchService::sendNotifications($find, Auth::user());
        }
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
