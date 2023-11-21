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
        $info = ConsistentSearchService::getConsistentSearches( self::FIELD);
        $find = [];
        if(count( $info ) > 0) {
            foreach ($info  as $value) {
                $get = false;
                $haystack = array_flip(explode(' ', strtolower($value['search_text'])));
                $needles = explode(' ', strtolower($lastName['last_name']));
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
