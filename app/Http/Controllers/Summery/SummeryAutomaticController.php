<?php

namespace App\Http\Controllers\Summery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SummeryAutomaticController extends Controller
{
    public function index() {
      return view('bibliography.summary_automatic');
    }
}
