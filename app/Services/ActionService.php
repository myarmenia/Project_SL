<?php

namespace App\Services;

use App\Models\Action;
use App\Models\Man\Man;

class ActionService
{
    /**
     * @return int
     */
    public function store(): int
    {
        return Action::create()->id;
    }

    /**
     * @param  object  $action
     * @param  array  $attributes
     * @return mixed|null
     */
    public function update(object $action, array $attributes): mixed
    {
        return ComponentService::update($action, $attributes);
    }
}
