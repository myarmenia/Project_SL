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
        $datas =  $this->fileSearcheService->solrSearch($request['search_input'],$request->content_distance ?? 2);

        $search_input = $request['search_input'];

        $distance = $request->content_distance;
// dd($datas);
    return view('search-file.index',compact('datas','search_input','distance'));
  }

  public function generate_file_from_result(Request $request){
$search_word="ՄԱՐԶԱՅԻՆ";
        $file=File::find(38);
        $path=$file->path;
        $fullPath = storage_path('app/' . $path);
       $text=getDocContent($fullPath);
    //    dd($text);
        // dd($fullPath);
        $read_file = $this->wordFileReadService->read_word($fullPath,$text,$search_word);
        // $phpWord = IOFactory::load($fullPath);
        // $sections = $phpWord->getSections();

        // foreach ($sections as $section) {
        //     $get_section=$section->getElements();
        //     // dd($get_section);
        //     foreach($get_section as $rows){
        //         if(count($rows->getElements())!==0){
        //             $row=$rows->getElements();
        //             foreach($row as $item){
        //                 dd($item);
        //                 if($item->getText() !== ''){

        //                 }
        //                 if($item instanceof \PhpOffice\PhpWord\Element\TextRun){
        //                     dd($item->getElements()[0]);

        //                 }
        //                 // $explode_text = explode(" ",$item->getText());
        //                 // foreach( $explode_text as $data){
        //                 //     if($data == $search_word){
        //                 //         dd(56);
        //                 //     }
        //                 // }



        //             }
        //         }
        //     }

        // }




  }
}
