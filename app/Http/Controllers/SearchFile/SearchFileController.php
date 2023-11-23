<?php

namespace App\Http\Controllers\SearchFile;

use App\Http\Controllers\Controller;
use App\Models\File\File;
use Illuminate\Http\Request;
use App\Services\SimpleSearch\FileSearcheService;
use Illuminate\Contracts\View\View;

class SearchFileController extends Controller
{
    public function __construct(private FileSearcheService $fileSearcheService) {

        $this->fileSearcheService = $fileSearcheService;
    }
  public function search_file()
  {

    return view('search-file.index');
  }

  function search_file_result(Request $request): View
  {
        $datas =  $this->fileSearcheService->solrSearch($request['search_input'],$request->content_distance ?? 2);

        $search_input = $request['search_input'];

        $distance = $request->content_distance;
// dd($datas);
    return view('search-file.index',compact('datas','search_input','distance'));
  }
  public function generate_file_from_result(Request $request){

    $arr=[3,17];
    $file=File::find(3);
    dd($file->path);
    // Storage::



  }
}
