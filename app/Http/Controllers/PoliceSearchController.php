<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\PoliceSearchService;
use Illuminate\Http\Request;

class PoliceSearchController extends Controller
{
    protected $policeSearchService;

    public function __construct(PoliceSearchService $policeSearchService)
    {
        $this->policeSearchService = $policeSearchService;
    }

    public function searchPolice(Request $request)
    {  
        $searchInfo = $this->policeSearchService->searchPolice($request->all()); 

        return view('searche.searche', compact('searchInfo'));
    }
}
