<?php

namespace App\Services;


use App\Models\File\File;
use App\Models\MiaSummary;
use Illuminate\Support\Facades\DB;

class MiaSummaryService
{

    /**
     * @return int
     */
    public function store($bibliography_id): int
    {

        return MiaSummary::create(['bibliography_id'=>$bibliography_id])->id;
    }
    public function update(object $miaSummary, array $attributes){
   
        return  ComponentService::update($miaSummary,$attributes);
    }

}
