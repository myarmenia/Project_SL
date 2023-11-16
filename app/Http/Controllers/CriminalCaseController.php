<?php

namespace App\Http\Controllers;

class CriminalCaseController extends Controller
{
    public function create(){
        return view('criminal-case.index');
    }
}
