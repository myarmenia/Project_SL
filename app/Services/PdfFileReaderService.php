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

        $content = $pdf->getText();


        $explode_string = explode("\t\n",$content);

// dd($explode_string);

    $new_array=[];
        foreach ($explode_string as $key => $value) {
            // dd($value);
            if(str_contains($value,"\t") && !str_contains($value,"\n\n")  ){

                array_push($new_array,$value);
            }

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
    // dd($dataToAppend);
    // Append the data to a new row in the worksheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();
    $row=0;

    foreach($dataToAppend as $key=>$item){
        $row++;
        $exp_row=explode("\t",$item);
        // dd($exp_row);
        foreach($exp_row as $coll=>$coll_value){

            $cell = $worksheet->getCellByColumnAndRow($coll, $row);
            $cell->setValue($exp_row[$coll]);
        }
    }



// dd($worksheet);
     // Save the Excel file
     $excelWriter = new Xlsx($spreadsheet);
     $excelFileName = 'Excel 6.xlsx';
     $excelWriter->save(storage_path('app/' . $excelFileName));

     // Return a download link to the user
     $fileDetails = [
        'file_name'=> $fileName,
        'real_file_name'=> $file->getClientOriginalName(),
        'file_path'=> $path,
        'fileId'=> $fileId,
    ];
    $getInfo=New findDataService();
    // $getInfo->addFindDataToInsert($dataToInsert, $fileDetails);



    BibliographyHasFile::bindBibliographyFile($bibliographyId, $fileId);
    return $fileName;
    }



}




