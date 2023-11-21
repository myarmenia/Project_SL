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
        $info = ConsistentSearchService::getConsistentSearches( self::FIELD);
        $find = [];
        if(count( $info ) > 0) {
            foreach ($info  as $value) {
                $get = false;
                $haystack = array_flip(explode(' ', strtolower($value['search_text'])));
                $needles = explode(' ', strtolower($middleName['middle_name']));
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
