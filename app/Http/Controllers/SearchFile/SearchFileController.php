<?php

namespace App\Http\Controllers\SearchFile;

use App\Events\ConsistentSearchEvent;
use App\Http\Controllers\Controller;
use App\Models\File\File;
use Illuminate\Http\Request;
use App\Services\SimpleSearch\FileSearcheService;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpWord\IOFactory;
use App\Services\WordFileReadService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SearchFileController extends Controller
{
    public function __construct(private FileSearcheService $fileSearcheService, private  WordFileReadService $wordFileReadService)
    {

        $this->fileSearcheService = $fileSearcheService;
        $this->wordFileReadService = $wordFileReadService;
    }
    public function search_file()
    {

        return view('search-file.index');
    }

    function search_file_result(Request $request): View
    {
        $request->flashOnly([

                'search_input',
                'distance',
                'word_count',
                'revers_word',
                'car_number',
                'search_synonims'
            ]);


        $datas =  $this->fileSearcheService->solrSearch(
            $request->search_input,
            $request->content_distance ?? 2,
            $request->word_count,
            $request->revers_word ?? null,
            [
                'car_number' => $request->car_number,
                'search_synonims' => $request->search_synonims
                ] );

        event(new ConsistentSearchEvent('man',$request->search_input,'searching'));

    return view('search-file.index',compact('datas'))->with(['distance' => $request->content_distance]);

  }



    public function generate_file_from_result(Request $request)
    {
// dd($request->all);
        $read_file = $this->wordFileReadService->read_word($request->all());

        if ($read_file) {
            return response()->json(['message' => 'file_has_been_gererated']);
        }
    }
}
