<?php

namespace App\Observers;

use App\Models\FirstName;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Support\Facades\Auth;

class FirstNameObserver
{

    const FIELD = 'man';

    /**
     * Handle the FirstName "created" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function created(FirstName $firstName)
    {
        $info = ConsistentSearchService::getConsistentSearches( self::FIELD);
        $find = [];
        if(count( $info ) > 0) {
            foreach ($info  as $value) {
                $get = false;
                $haystack = array_flip(explode(' ', strtolower($value['search_text'])));
                $needles = explode(' ', strtolower($firstName['first_name']));
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
     * Handle the FirstName "updated" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function updated(FirstName $firstName)
    {
        //
    }

    /**
     * Handle the FirstName "deleted" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function deleted(FirstName $firstName)
    {
        //
    }

    /**
     * Handle the FirstName "restored" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function restored(FirstName $firstName)
    {
        //
    }

    /**
     * Handle the FirstName "force deleted" event.
     *
     * @param  \App\Models\FirstName  $firstName
     * @return void
     */
    public function forceDeleted(FirstName $firstName)
    {
        //
    }
}
