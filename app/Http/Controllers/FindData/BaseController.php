<?php

namespace App\Http\Controllers\FindData;

use App\Http\Controllers\Controller;
use App\Services\FindDataService;

class BaseController extends Controller
{
    public $service;

    public function __construct(FindDataService $service)
    {
        $this->service = $service;
    }

}