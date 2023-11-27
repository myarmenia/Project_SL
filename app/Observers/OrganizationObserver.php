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
        $diff = array_diff_assoc($organization->attributesToArray(),$organization->getRawOriginal());
        $diff = Arr::except($diff,['created_at','updated_at']);
        if(isset($diff['name'])) {
            event(new ConsistentSearchEvent(ConsistentSearch::SEARCH_TYPES['ORGANIZATION'],$diff['name'], ConsistentSearch::NOTIFICATION_TYPES['INCOMING']));
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
