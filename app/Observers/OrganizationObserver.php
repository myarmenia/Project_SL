<?php

namespace App\Observers;

use App\Events\ConsistentSearchEvent;
use App\Models\ConsistentSearch;
use App\Models\Organization;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        if(isset($organization->name)) {
            event(new ConsistentSearchEvent(ConsistentSearch::SEARCH_TYPES['ORGANIZATION'],$organization->name, ConsistentSearch::NOTIFICATION_TYPES['INCOMING']));
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
