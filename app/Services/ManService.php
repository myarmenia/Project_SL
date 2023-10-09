<?php

namespace App\Services;

use App\Models\Man\Man;

class ManService
{
    /**
     * @return int
     */
    public function store(): int
    {

        $a = Man::create()->id;
        return Man::create()->id;
       
    }
}
