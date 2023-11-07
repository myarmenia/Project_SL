<?php

namespace App\Services;

// use App\Models\Bibliography\Bibliography;
// use App\Models\Bibliography\BibliographyHasCountry;
// use App\Models\Bibliography\BibliographyHasFile;
use App\Models\File\File;
use App\Models\Signal;
use Illuminate\Support\Facades\DB;

class SignalService
{


    /**
     * @return int
     */
    public function store(): int
    {

        return Signal::create()->id;
    }
    public function update(object $signal, array $attributes){
    // dd($attributes);
        return  ComponentService::update($signal,$attributes);
    }

}
