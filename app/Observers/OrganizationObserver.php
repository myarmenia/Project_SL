<?php

namespace App\Observers;

use App\Models\Organization;
use App\Models\User;
use App\Notifications\ConsistentNotification;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OrganizationObserver
{
     const FIELD = 'organization';

    /**
     * Handle the Organization "created" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function created(Organization $organization)
    {
        //
    }

    /**
     * Handle the Organization "updated" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function updated(Organization $organization)
    {
        $diff = array_diff_assoc($organization->attributesToArray(),$organization->getRawOriginal());
        $diff = Arr::except($diff,['created_at','updated_at']);
        $info = ConsistentSearchService::getConsistentSearches( OrganizationObserver::FIELD);
        $find = [];
        if(count( $info ) > 0) {
            if(isset($diff['name'])) {
                foreach ($info  as $value) {
                    $get = false;
                    $haystack = array_flip(explode(' ', strtolower($value['search_text'])));
                    $needles = explode(' ', strtolower($diff['name']));
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
        }

        if(count( $find ) > 0) {
            ConsistentSearchService::sendNotifications($find, Auth::user());
        }
    }


    /**
     * Handle the Organization "deleted" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function deleted(Organization $organization)
    {
        //
    }

    /**
     * Handle the Organization "restored" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function restored(Organization $organization)
    {
        //
    }

    /**
     * Handle the Organization "force deleted" event.
     *
     * @param  \App\Models\Organization  $organization
     * @return void
     */
    public function forceDeleted(Organization $organization)
    {
        //
    }
}
