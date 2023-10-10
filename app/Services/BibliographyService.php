<?php

namespace App\Services;

use App\Models\Bibliography\Bibliography;
use App\Models\File\File;

class BibliographyService
{


    /**
     * @return int
     */
    public function store(): int
    {

        return Bibliography::create(['user_id' => auth()->id()])->id;
    }
}
