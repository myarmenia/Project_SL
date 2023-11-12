<?php

namespace App\Services;

use App\Models\Organization;

class OrganizationService
{
    public function store(): int
    {
      return Organization::create()->id;
    }

    public function update(object $organization, array $attributes)
    {
        return ComponentService::update($organization, $attributes);
    }
}
