<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;


class SearchController extends Controller
{

    public function showUploadForm()
    {
        $basePath = 'uploads/';
        $files = Storage::files($basePath);
        $cleanedFiles = array_map(function ($file) use ($basePath) {
            return str_replace($basePath, '', $file);
        }, $files);

        return view('search.upload', compact('cleanedFiles'));
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $fileName);
        $fullPath = storage_path('app/' . $path);

        if ($file) {
            $phpWord = IOFactory::load($fullPath);
            $content = '';

            $sections = $phpWord->getSections();
            foreach ($sections as $section) {
                foreach ($section->getElements() as $element) {
                    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        foreach ($element->getElements() as $textElement) {
                            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                $content .= $textElement->getText() . ' ';
                            }
                        }
                    }
                }

            }
            $text = $content;
            $parts =  explode("\t", $text);
            $dataToInsert = [];
            $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
            foreach ($parts as $key => $part) {
                if($text){
                    preg_match_all($pattern, $part, $matches, PREG_SET_ORDER);
                    foreach ($matches as $key => $value) {
                        $valueAddress = str_replace("թ.ծ.,", "", $value[5]);
                        $surname = $value[3];
                        $text = trim($part);
                        $text = mb_ereg_replace($value[0], "<p style='color: #0c05fb; margin: 0;'>$value[0]</p>", $text);
                        if (Str::endsWith($value[3], 'ը') || Str::endsWith($value[3], 'ի')) {
                            $surname = Str::substr($value[3], 0, -1);
                        }
                        if( mb_substr($value[3], -2, 2, 'UTF-8') == 'ից' || mb_substr($value[3], -2, 2, 'UTF-8') == 'ին'){
                            $surname = Str::substr($value[3], 0, -2);
                        }
                        $dataToInsert[] = [
                            'name' => $value[1],
                            'surname' => $surname,
                            'patronymic' => $value[2],
                            'birthday' => $value[4],
                            'address' => $valueAddress . $value[6],
                            'findText' => $text,
                            'fileName' => $fileName
                        ];
                    }
                }
            }

            DataUpload::insert($dataToInsert);

        }

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function showFileDetails($filename)
    {
        // Определите логику для получения информации о файле по имени файла.
        // Например, используйте mime тип файла для определения его типа.

        // Передайте информацию о файле в вид
        $fileType = [];
        return view('file-details', ['filename' => $filename, 'fileType' => $fileType]);
    }

    public function seeFileText()
    {
        // $lang = config('app.locale');

        // if(session()->has('locale')){
        //     $lang = session()->get('locale');
        // }

        // App::setLocale($lang);
        // dd( $request->getHost());

        return view('search.file-details');

    }

    public function file($lang, $filename)
    {
        $filePath = 'uploads/' . $filename;
        $fullPath = storage_path('app/' . $filePath);

//         if (Storage::exists($filePath)) {
//             $phpWord = IOFactory::load($fullPath);

//             $content = '';

//             $sections = $phpWord->getSections();
//             foreach ($sections as $section) {
//                 foreach ($section->getElements() as $element) {
//                     if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
//                         foreach ($element->getElements() as $textElement) {
//                             if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
//                                 $content .= $textElement->getText() . ' ';
//                             }
//                         }
//                     }
//                 }

//             }
//             $text = $content;

//             // var_dump($text);
//             // print_r($text);
//             // '/^([Ա-Ֆ][ա-ֆևv]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև+)\s/ \d{2,}.\d{2,}.\d{2,}$/u';
//             // $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)/u';
//             //default pattern Anun Hayranun Azganun /20.05.1888
//             $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/\d{2,}.\d{2,}.\d{2,}/u';
//             //defapatternTwoult pattern Anun Hayranun? Azganun /20.05.1888 || /1885
//             $patternTwo = '/([Ա-Ֆ][ա-ֆև]+)\s+(([Ա-Ֆ][ա-ֆև]+)\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.)?(\d{2,}.)?\d{2,}/u';
//             //defapatternThree pattern Anun ev Anun azganun
//             // $patternThree = '/([Ա-Ֆ][ա-ֆև]+)\s+ և + \s ([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)/u';
//             $patternThree = '/\/(.+?)\//u';

//             //defpatternfour get address
//             $patternFour = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\\/(.+?)\/ /u';

//             //good work
//             $patternFive = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+[\/\d{2,}.\d{2,}.\d{2,}]\s*(.+?)\//u';
//             //version two good work
//             // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+[\/\d{2,}.\d{2,}.\d{2,}]\s*(.+?)բն\.[0-9]+ /u';
//             // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+[\/\d{2,}.\d{2,}.\d{2,}]\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/)/u';
//             // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | բն\.[0-9]+.\/.] | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
//             // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | բն\.[0-9]+.\/.] | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
//             // $patternSix = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.?\d{2,}.?\d{2,}?)\s*(.+?)\s*(բն\.[0-9]+. | բն\.[0-9]+.\/.] | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.))/u';
//             $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.?\d{2,}.?\d{2,}?)\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';

//             $parts =  explode("\t", $text);
// $textNewLines = implode("\n", $parts);
//             // preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
//             // preg_match_all($patternTwo, $text, $matchesTwo, PREG_SET_ORDER);
//             // preg_match_all($patternThree, $text, $matchesThree, PREG_SET_ORDER);
//             preg_match_all($patternSix, $textNewLines, $matchesFour, PREG_SET_ORDER);
//             dd($matchesFour);


//             return view('search.file-details', compact('content'));
//             // return redirect()->route('fileShow', compact('content'));

//         } else {
//             return 'File Not found.';
//         }
       
       
       
       
        $fileDetails = DataUpload::where('fileName', $filename)->get();
   
        return view('search.file-details', compact('fileDetails'));  


    }

    public function destroyDetails($rowId)
    {
        DataUpload::destroy($rowId);

        return redirect()->back()->with('success', 'deleted');
    }

    public function editDetails($local, $id)
    {
        $details = DataUpload::find($id);
    
        return view('search.edit-details',compact('details'));
    }

    public function updateDetails(Request $request, $local, $id)
    {
        $input = $request->all();
    
        $details = DataUpload::find($id);
        $details->update($input);

        return redirect()->route('file.details', ['locale' => app()->getLocale(), 'filename' => $details->fileName])
                        ->with('success','Row updated successfully');
    }

    public function editDetailItem(Request $request, $id)
    {
        $data = $request->all();
        $details = DataUpload::find($id);
        $details->update([
            $data['column'] => $data['newValue']
        ]);

        return response()->json(['message'=>"Edited Succesfully"]);
    }
}