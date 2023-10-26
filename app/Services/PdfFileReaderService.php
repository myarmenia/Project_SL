<?php

namespace App\Services;
use App\Models\File\File;
use Illuminate\Support\Facades\DB;
use Smalot\PdfParser\Parser;

// use Spatie\PdfToText\Pdf;
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
// dd($content);

        $explode_string = explode("\t\n",$content);
        // $explode_string = explode("\n\n",$content);

dd($explode_string);

    $new_array=[];
        foreach ($explode_string as $key => $value) {
            // dd($value);
            if(str_contains($value,"\t") ){

                array_push($new_array,$value);
            }
        }




        foreach($new_array as $key=>$data){
            // dd($key);
            if(str_contains($data,"\n\n")){
                // dd(4444);
                unset($new_array[$key]);
                $new_array=$new_array;
            }
            // if(str_contains($data,"\t")){
            //     $exp_value = explode("\t",$data);
            //     // dd($exp_value[0]);
            //     if((!is_numeric($exp_value[0]) && $key>0) || count($exp_value)<4 ){

            //         $k=$key-1;

            //         $new_array[$k] = $new_array[$k]."\t".$new_array[$key];
            //         unset($new_array[$key]);


            //     }

            // }





        }
        dd($new_array);



    $dataToAppend =$new_array;
    // Append the data to a new row in the worksheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();

        for ($row =0; $row <= 7; $row++) {


                // dd($dataToAppend[3]);
                $exp_row=explode("\t",$dataToAppend[$row]);
                // dd($exp_row);
                for($col = 0; $col<=count($exp_row); $col++){
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);

                    $cell->setValue($exp_row[$col]);
                }





        }
// $row=1;
// for ($col = 1; $col <= count($dataToAppend); $col++) {
//     $cell = $worksheet->getCellByColumnAndRow($col, $row);
//     $cell->setValue($dataToAppend[$col - 1]);
// }
// dd($worksheet);
     // Save the Excel file
     $excelWriter = new Xlsx($spreadsheet);
     $excelFileName = 'Excel 6.xlsx';
     $excelWriter->save(storage_path('app/' . $excelFileName));

     // Return a download link to the user
     return response()->download(storage_path('app/' . $excelFileName))->deleteFileAfterSend();



    }
}


