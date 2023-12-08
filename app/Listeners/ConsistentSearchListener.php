<?php

namespace App\Listeners;

use App\Events\ConsistentSearchEvent;
use App\Services\ConsistentSearch\ConsistentSearchService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConsistentSearchListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * @param ConsistentSearchEvent $event
     */
    public function handle(ConsistentSearchEvent $event)
    {
        ConsistentSearchService::search($event->field, $event->text, $event->type, $event->id);
    }



}
