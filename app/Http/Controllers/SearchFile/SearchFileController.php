<?php

namespace App\Http\Controllers\SearchFile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchFileController extends Controller
{
  public function search_file(Request $request)
  {
    return view('search-file.index');
  }
}
