<?php

namespace App\Services;

use App\Models\Organization;

class OrganizationService
{
    public function store(): int
    {
        $organization = Organization::create();

        if (request()->model === 'bibliography') {
            $organization->bibliography()->attach(request()->id);
        }

        return $organization->id;
    }

    public function update(object $organization, array $attributes)
    {
        return ComponentService::update($organization, $attributes);
    }
}
