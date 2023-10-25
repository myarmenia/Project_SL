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
dd($content);
        // dd(gettype($content));
        $explode_string = explode("\t\n",$content);
        // dd($explode_string);
        $names_array=array_filter($explode_string, function($value){

                            return  $value!== ''  ;
                        });
                        // dd($names_array);


        // Define the Excel file name



        $spreadsheet = new Spreadsheet();
//         $fullex = storage_path('app/Excel 6.xlsx');

// //  dd($spreadsheet);
//         $sheet = $spreadsheet->getActiveSheet();
//         // dd($sheet);

//         // Split the PDF text into lines and add them to the Excel sheet
//         // $lines = explode("\n", $pdfText);
//         $lines = explode("\n",  $content);
//         // dd($lines);
//         foreach ($lines as $line) {
//             $rowData = explode("\t", $line);
// // dd($rowData);
//             $sheet->appendRow($rowData);
//         }
//         // dd($sheet);
//           // Save the Excel file
//           $excelWriter = new Xlsx($spreadsheet);
//           $excelWriter->save(storage_path('app/' . $excelFileName));

//           // Return a download link to the user
//           return response()->download(storage_path('app/' . $excelFileName))->deleteFileAfterSend();
//         //

          // Create an array with the data you want to append to the row
    // $dataToAppend = ['Column 4 Data', 'Column 5 Data', 'Column 6 Data'];
    $dataToAppend =$names_array;
    // Append the data to a new row in the worksheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
// $worksheet = $spreadsheet->getActiveSheet();
    $worksheet = $spreadsheet->getActiveSheet();
    $worksheet->appendRow($dataToAppend);
    dd($worksheet);
    // $worksheet= $spreadsheet->appendRow($dataToAppend);
    $row = 1;

// Loop through the data and set the values in the cells
for ($col = 1; $col <= count($dataToAppend); $col++) {
    $cell = $worksheet->getCellByColumnAndRow($col, $row);
    $cell->setValue($dataToAppend[$col - 1]);
}
// dd($worksheet);
     // Save the Excel file
     $excelWriter = new Xlsx($spreadsheet);
     $excelFileName = 'Excel 6.xlsx';
     $excelWriter->save(storage_path('app/' . $excelFileName));

     // Return a download link to the user
     return response()->download(storage_path('app/' . $excelFileName))->deleteFileAfterSend();



    }
}


