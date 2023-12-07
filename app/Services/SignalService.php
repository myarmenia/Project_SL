<?php

namespace App\Services;

// use App\Models\Bibliography\Bibliography;
// use App\Models\Bibliography\BibliographyHasCountry;
// use App\Models\Bibliography\BibliographyHasFile;
use App\Models\File\File;
use App\Models\Signal;
use App\Services\Log\LogService;
use Illuminate\Support\Facades\DB;

class SignalService
{


    /**
     * @return int
     */
    public function store($bibliography_id): int
    {

        return Signal::create(['bibliography_id'=>$bibliography_id])->id;
    }
    public function update(object $signal, array $attributes){

        return  ComponentService::update($signal,$attributes);
    }

}
