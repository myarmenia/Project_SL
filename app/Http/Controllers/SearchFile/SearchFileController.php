<?php

namespace App\Http\Controllers\SearchFile;

use App\Http\Controllers\Controller;
use App\Models\File\File;
use Illuminate\Http\Request;
use App\Services\SimpleSearch\FileSearcheService;
use App\Services\WordFileService;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpWord\IOFactory;
use Services\WordFileReaderService;
use Illuminate\Support\Str;

class SearchFileController extends Controller
{
    public function __construct(private FileSearcheService $fileSearcheService ) {

        $this->fileSearcheService = $fileSearcheService;
        // $this->wordFileReaderService = $wordFileReaderService;
        // dd($this->wordFileReaderService);
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
        // $read_file = $this->wordFileReaderService::read_word($fullPath);
        $phpWord = IOFactory::load($fullPath);
        $sections = $phpWord->getSections();

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
        $arr=[];

        $explode_text = explode("\t",$text);
        // dd($explode_text);
        foreach($explode_text as $item){
            $exploded_iner_text=explode(" ",$item);
            foreach($exploded_iner_text as $data){
                // dd($data);
                if(Str::contains($data,$search_word)){
                    array_push($arr,$item);
                }
                // if($data==$search_word){
                //     // dd($data);

                // }

            }
        }
        // dd($arr);
        // $content='';
        // $paragraph="";
        // foreach ($sections as $section) {
        //     foreach ($section->getElements() as $element) {
        //         if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
        //             foreach ($element->getElements() as $textElement) {
        //                 if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
        //                     $content .= $textElement->getText() . '';
        //                 }
        //             }
        //             $paragraph.="section/".$content;
        //         }
        //     }
        // }
        // dd($paragraph);
        // return $paragraph;


  }
}
