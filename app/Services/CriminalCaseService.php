<?php

namespace App\Services;

use App\Models\CriminalCase;

class CriminalCaseService
{
    /**
     * @param  object  $man
     * @param  array  $request
     * @return void
     */
    public function store($bibliography_id): int
    {
        return CriminalCase::create(['bibliography_id'=>$bibliography_id])->id;
    }

    public function update(object $criminalCase, array $attributes)
    {

        return ComponentService::update($criminalCase, $attributes);

    }
}
