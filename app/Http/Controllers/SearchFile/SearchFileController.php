<?php

namespace App\Http\Controllers\SearchFile;

use App\Utils\Paginate;
use App\Models\File\File;
use Illuminate\Http\Request;
use App\Services\Log\LogService;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Events\ConsistentSearchEvent;
use App\Services\WordFileReadService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Services\SimpleSearch\FileSearcheService;


class SearchFileController extends Controller
{
    public function __construct(private FileSearcheService $fileSearcheService, private  WordFileReadService $wordFileReadService)
    {

        $this->fileSearcheService = $fileSearcheService;
        $this->wordFileReadService = $wordFileReadService;
    }

    function search_file(Request $request): View
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

        //TODO: Please add 4rd parameter man_id and uncomment
       event(new ConsistentSearchEvent('man',$request->search_input,'searching',0));
       LogService::store(['search_text' => $request->search_input], null, 'file_texts', 'file_text_search');

    return view('search-file.index',compact('datas'))->with(['distance' => $request->content_distance]);

  }

    public function generate_file_from_result(Request $request)
    {

        $file_array = [$request->all()];

        $day = \Carbon\Carbon::now()->format('d-m-Y');
        // $desktopPath = getenv('USERPROFILE') . "\Desktop/".$day;// For Windows
        $desktopPath = $_SERVER['HOME'] . "\Desktop/".$day; // For Linux/Mac

        $file_array = File::whereIn('id',$file_array)->get();

        $folder_file_count=0;

        foreach($file_array as $data){

            if (Storage::exists($data->path)) {
                $path = Storage::disk('local')->path($data->path);
                $fileContents = Storage::get($data->path);

                if (!file_exists($desktopPath)) {
                    mkdir($desktopPath, 0777, true);
                }
                $filename = $desktopPath . "/" . $data->real_name;

                $file_handle = fopen($filename, 'w + ');

                fwrite($file_handle, $fileContents);
                fclose($file_handle);

                $folder_file_count+=1;

            }

        }
        // dd($folder_file_count);

         if (count($file_array)==$folder_file_count) {
            $message ='file_has_been_gererated';
        }else{
            $message ='response file not generated';
        }

         return response()->json(['message'=>$message]);


    }
}
