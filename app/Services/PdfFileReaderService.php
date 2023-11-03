<?php

namespace App\Services;

use App\Models\Bibliography\BibliographyHasFile;
use App\Models\File\File;
use Illuminate\Support\Facades\DB;
use Smalot\PdfParser\Parser;


 use PhpOffice\PhpSpreadsheet\IOFactory;
use Spatie\PdfToText\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class PdfFileReaderService
{


    public  static function get($request)
    {
        // dd($lang);
        $bibliographyId = $request['bibliography_id'];
        $lang = $request['lang'];
        $title = $request['title'];

        $column_name =FileReaderComponentService::get_column_name($request['column_name']);

        $file = $request['file'];

        $folder_path = 'bibliography'. '/' . $bibliographyId;

        $fileName = time() . '_' . $file->getClientOriginalName();
        // dd($fileName);

        $path = FileUploadService::upload($file, $folder_path);
        // // dd($path);
        $file_content = [];
        $file_content['name'] = $fileName;
        $file_content['real_name'] = $file->getClientOriginalName();
        $file_content['path'] = $path;

        $fileId = DB::table('file')->insertGetId($file_content);
        // dd($request);
        $fullPath = storage_path('app/' . $path);
        // dd($fullPath);
        $pdfParser = new Parser();
        $pdf = $pdfParser->parseFile($fullPath);
        // $content= Pdf::getText($fullPath);
        $content = $pdf->getText();
        $dataToInsert=[];



        $explode_string = explode("\t\n",$content);

// dd($explode_string);

    $new_array=[];
        foreach ($explode_string as $key => $value) {
            // dd($value);
            if(str_contains($value,"\t") && !str_contains($value,"\n\n")  ){

                array_push($new_array,$value);
            }

        }


if($title == 'has_title'){

    array_shift($new_array);

}
// dd($new_array);
        foreach($new_array as $key=>$data){

            if(str_contains($data,"\t")){
                $exp_value = explode("\t",$data);



                if((!is_numeric($exp_value[0]) && $key>=0) || count($exp_value)<4 ){
                    if($key >0){
                        $k=$key-1;
                        $new_array[$k] = $new_array[$k]."\t".$new_array[$key];
                    }
                    unset($new_array[$key]);

                }

            }

        }
        // dd($new_array);



    $dataToAppend = $new_array;

    $row=0;
    // dd($dataToAppend);

    // foreach($dataToAppend as $key=>$item){
    //     $row++;

    //     $exp_row = explode("\t",$item);


    //     foreach($exp_row as $coll=>$coll_value){
    //         // dd($coll);

    //         $cell = $worksheet->getCellByColumnAndRow($coll, $row);
    //         $cell->setValue($exp_row[$coll]);
    //     }
    // }

    // dd($dataToAppend[13]);
    // $exp_row = explode("\t",$dataToAppend[12]);
    // // dd($exp_row);
    // foreach($exp_row as $coll=>$item){
    //     if($column_name['first_name']==$coll){

    //         $dataToInsert[1]['name']=$item;
    //     }

    //     if($column_name['last_name']==$coll){
    //         // dd($column_name['last_name']);
    //         // dd($item);
    //         // dd($coll);
    //         $pattern = "/\d/";
    //         $matched=preg_match($pattern, $item);

    //         if(preg_match($pattern, $item)) {
    //             $dataToInsert[1]['surname']=null;
    //         }else{

    //             $dataToInsert[1]['surname']=$item;
    //         }
    //     }
    //     if($column_name['birthday']==$coll){
    //         if(preg_match($pattern, $item)) {
    //             // dd($item);
    //             $dataToInsert= self::get_birthday($coll,12,$column_name,$item,$dataToInsert);
    //         }
    //     }
    // }
    // dd($dataToInsert);
    // dd($exp_row);
    $pattern = "/\d/";
    foreach($dataToAppend as $data=>$item){
        $row++;

        $exp_row = explode("\t",$item);
        foreach($exp_row as $key=>$item){
            // dd($coll);
           
            if($column_name['first_name']==$key){

                if(preg_match($pattern, $item)) {

                    $dataToInsert[$row]['name'] = null;

                }else{

                    if($lang!='armenian'){

                        // $translate_text['name'] =ucfirst($item);
                        $translate_text['name'] =$item;
                        $result = TranslateService::translate($translate_text);

                        $translated_name = $result['translations']['armenian']['name'];
                        // dd(gettype($translated_name));
                        // $dataToInsert[$data]['name'] = ucfirst($translated_name);
                        $dataToInsert[$row]['name'] =$translated_name;
                        // dd($dataToInsert);



                    }else{
                        // dd($result);
                        // $dataToInsert[$data]['name'] = ucfirst($item);
                        $dataToInsert[$row]['name'] = $item;

                    }
                }
            }
            if($column_name['last_name']==$key){

                // եթե մեջը թիվ կա
                if(preg_match($pattern, $item)) {
                    $dataToInsert[$row]['surname'] = null;
                    // $new_key=$key+1;
                    if($dataToInsert[$row]['surname']==null){
                        // if($column_name['birthday']== $new_key){
                            $dataToInsert= self::get_birthday($key,$row,$column_name,$item,$dataToInsert);


                        // }

                    }


                }else{
                    if($lang!='armenian'){
                        // $translate_text['name'] = ucfirst($item);
                        $translate_text['name'] = $item;
                        $result = TranslateService::translate($translate_text);
                        $translated_name = $result['translations']['armenian']['name'];


                        // $dataToInsert[$data]['surname'] = ucfirst($translated_name);
                        $dataToInsert[$row]['surname'] = $translated_name;

                    }else{
                        $dataToInsert[$row]['surname'] = $item;
                        // $dataToInsert[$data]['surname'] = ucfirst($item);

                    }

                }

            }
            if($column_name['middle_name']==$key){

                if(preg_match($pattern, $item)) {

                    $dataToInsert[$row]['name'] = null;

                }else{

                    if($lang!='armenian'){

                        // $translate_text['name'] =ucfirst($item);
                        $translate_text['name'] =$item;
                        $result = TranslateService::translate($translate_text);

                        $translated_name = $result['translations']['armenian']['name'];
                        // dd(gettype($translated_name));
                        // $dataToInsert[$data]['name'] = ucfirst($translated_name);
                        $dataToInsert[$row]['patronymic'] =$translated_name;
                        // dd($dataToInsert);

                    }else{
                        // dd($result);
                        // $dataToInsert[$data]['name'] = ucfirst($item);
                        $dataToInsert[$row]['patronymic'] = $item;

                    }
                }
            }

            if($column_name['birthday']==$key){
                if(preg_match($pattern, $item)) {
                    // dd($item);
                    $dataToInsert= self::get_birthday($key,$row,$column_name,$item,$dataToInsert);
                }
            }
        }

    }

    // dd($dataToInsert);

    $fileDetails = [
        'file_name'=> $fileName,
        'real_file_name'=> $file->getClientOriginalName(),
        'file_path'=> $path,
        'fileId'=> $fileId,
    ];
    $getInfo=New findDataService();
    $getInfo->addFindDataToInsert($dataToInsert, $fileDetails);

    BibliographyHasFile::bindBibliographyFile($bibliographyId, $fileId);

    return $fileName;
    }


    public static function get_birthday($key,$data,$column_name,$item,$dataToInsert){
        // dd(gettype($item));
        // dd($key,$data,$column_name,$item,$dataToInsert);
                if($item==null){

                    $dataToInsert[$data]['birth_year'] = null;
                    $dataToInsert[$data]['birthday_str'] = null;
                    $dataToInsert[$data]['birth_day'] = null;
                    $dataToInsert[$data]['birth_month'] = null;

                }else{
                    // dd(strlen($item));


                    if(strlen($item)==10){

                        // $data='';
                        // if(str_contains($item, "/")){
                        //     $date = \Carbon\Carbon::createFromFormat('d/m/Y', $item);

                        // }
                        // if(str_contains($item,".")){
                        //     $date = \Carbon\Carbon::createFromFormat('d.m.Y', $item);

                        // }
                        // dd($item);


                        // dd(strlen($item));

                        $date =  $date = \Carbon\Carbon::createFromFormat('d/m/Y', $item);;
                        // dd($date);
                        $birthday_data=$date->format('Y-m-d');
                        $dataToInsert[$data]['birth_year'] = $date->format('Y');
                        $dataToInsert[$data]['birthday_str'] =$date->format('Y-m-d');
                        $dataToInsert[$data]['birth_day'] = $date->format('d');
                        $dataToInsert[$data]['birth_month'] = $date->format('m');

                        // dd($dataToInsert);
                    }
                    if(strlen($item)==4){
                        // եթե միայն տարին է
                        $dataToInsert[$data]['birth_year'] = $item;
                        $dataToInsert[$data]['birthday_str'] =$item;

                    }



                }
                // dd($dataToInsert);
                return $dataToInsert;

            }



}




