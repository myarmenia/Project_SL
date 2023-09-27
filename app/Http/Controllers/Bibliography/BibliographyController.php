<?php

namespace App\Http\Controllers\Bibliography;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BibliographyController extends Controller
{
    public function create() {
        return view('bibliography.create');
    }
}
