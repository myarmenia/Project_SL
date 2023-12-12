<?php

namespace App\Http\Controllers\SearchFile;

use App\Events\ConsistentSearchEvent;
use App\Http\Controllers\Controller;
use App\Models\ConsistentSearch;
use App\Models\File\File;
use App\Services\Log\LogService;
use Illuminate\Http\Request;
use App\Services\SimpleSearch\FileSearcheService;
use Illuminate\Contracts\View\View;
use App\Utils\Paginate;
use PhpOffice\PhpWord\IOFactory;
use App\Services\WordFileReadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class SearchFileController extends Controller
{
    public function __construct(private FileSearcheService $fileSearcheService)
    {

        $this->fileSearcheService = $fileSearcheService;

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
        if (!empty($datas)) {

            $datas = Paginate::paginate($datas,20);

            $serarch_input = urlencode($request->search_input);
            $revers_words = old('revers_word',$request->revers_words);

            $url = "search-file?word_count=$request->word_count&revers_word=$revers_words&search_synonims=$request->search_synonims&car_number=$request->car_number&content_distance=$request->content_distance&search_input=$serarch_input";

            $datas->withPath($url);
        }

        LogService::store($request->search_input,null,'file_texts','search_file');

        event(new ConsistentSearchEvent(ConsistentSearch::SEARCH_TYPES['MAN'], $request->search_input, ConsistentSearch::NOTIFICATION_TYPES['SEARCHING'], 0));

        return view('search-file.index',compact('datas'))->with(['distance' => $request->content_distance]);

  }

    public function generate_file_from_result(Request $request)
    {

        $file_array = $request->all();

        $day = \Carbon\Carbon::now()->format('d-m-Y');
        // $desktopPath = dirname("C:\Users\ADC-2\Desktop");
        // $desktopPath = $desktopPath."/".$day;
        $desktopPath = getenv('USERPROFILE') . "\Desktop/".$day;// For Windows
        // $desktopPath = $_SERVER['HOME'] . "\Desktop/".$day; // For Linux/Mac

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

        if (count($file_array) == $folder_file_count) {
            $message ='file_has_been_gererated';
        }else{
            $message ='response file not generated';
        }

         return response()->json(['message'=>$message]);


    }
}
