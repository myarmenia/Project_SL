<?php

namespace App\Services;

use App\Models\Event as ModelsEvent;

class EventService
{
    /**
     * @param  object  $man
     * @param  array  $request
     * @return void
     */
    public function store(): int
    {
        return ModelsEvent::create()->id;
    }
}
