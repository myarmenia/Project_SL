<?php

namespace App\Http\Controllers\SearchFile;

use App\Http\Controllers\Controller;
use App\Models\File\File;
use Illuminate\Http\Request;
use App\Services\SimpleSearch\FileSearcheService;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpWord\IOFactory;
use App\Services\WordFileReadService;


class SearchFileController extends Controller
{
    public function __construct(private FileSearcheService $fileSearcheService, private  WordFileReadService $wordFileReadService ) {

        $this->fileSearcheService = $fileSearcheService;
        $this->wordFileReadService = $wordFileReadService;


    }
  public function search_file()
  {

    return view('search-file.index');
  }

  function search_file_result(Request $request): View
  {
        $datas =  $this->fileSearcheService->solrSearch(
            $request->search_input,
            $request->content_distance ?? 2,
            $request->word_count ?? null,
            $request->revers_word ?? null );

        $search_input = $request->search_input;

        $distance = $request->content_distance;

    return view('search-file.index',compact('datas','search_input','distance'));
  }

  public function generate_file_from_result(Request $request){

        $search_word="ՄԱՐԶԱՅԻՆ";
        $file=File::find(38);
        $path=$file->path;
        $fullPath = storage_path('app/' . $path);
        $text=getDocContent($fullPath);

        $read_file = $this->wordFileReadService->read_word($fullPath,$text,$search_word);

  }
}
