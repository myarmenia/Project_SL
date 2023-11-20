<?php

namespace App\Services;

use App\Models\Action;
use App\Models\Man\Man;

class ActionService
{
    /**
     * @param  int  $id
     * @return Action
     */
    public function store(int $id): Action
    {
        return Action::create(['bibliography_id' => $id]);
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
