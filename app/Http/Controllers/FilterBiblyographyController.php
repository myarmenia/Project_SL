<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterBiblyographyController extends Controller
{
    public function filter(Request $request) {
        dd($request->all());
    }
}
