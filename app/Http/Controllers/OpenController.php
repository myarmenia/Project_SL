<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenController extends Controller
{
    public function index($lang, $page) {
        return view('open.' . $page);
    }
}
