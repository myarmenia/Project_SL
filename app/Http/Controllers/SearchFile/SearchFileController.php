<?php

namespace App\Http\Controllers\SearchFile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SimpleSearch\FileSearcheService;

class SearchFileController extends Controller
{
    public function __construct(private FileSearcheService $fileSearcheService) {

        $this->fileSearcheService = $fileSearcheService;
    }
  public function search_file(Request $request)
  {
    $datas =  $this->fileSearcheService->solrSearch($request['search_input'],2);

    return view('search-file.index',compact('datas'));
  }
}
