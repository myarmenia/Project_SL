<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use App\Services\SearchService;


class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

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

      










        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $fileName);
            $fullPath = storage_path('app/' . $path);

            $text = $this->searchService->getDocContent($fullPath);
            $parts = explode("\t", $text);
            // $textNewLines = implode("\n", $parts);
            $dataToInsert = [];
            // $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
            $pattern = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/((\d{2,}.)?(\d{2,}.)?(\d{2,}))\s*(.+?)\//u';

            foreach ($parts as $key => $part) {
                if ($text) {
                    preg_match_all($pattern, $part, $matches, PREG_SET_ORDER);
                    foreach ($matches as $key => $value) {
                        $birthDay = (int) $value[6] === 0 ? null : (int) $value[6];
                        $birthMonth = (int) $value[7] === 0 ? null : (int) $value[7];
                        $birthYear = (int) $value[8] === 0 ? null : (int) $value[8];

                        $address = mb_strlen($value[9], 'UTF-8') < 10 ? $address = '' : $value[9];
                        
                        // $valueAddress = preg_replace('/թ\\․\s+ծ\\.\\,/', "", $address);


                        $valueAddress = str_replace("թ.ծ.,", "", $address);
                        $valueAddress = str_replace("թ.ծ", "", $valueAddress);
                        $valueAddress = str_replace("թ. ծ.,", "", $valueAddress);
                        $valueAddress = str_replace("չի աշխ.", "", $valueAddress);
                     
                        $surname = trim($value[4] == "" ? $value[3] : $value[4]);
                        $patronymic = trim($value[4] == "" ? "" : $value[3]);

                        $text = trim($part);
                        $text = mb_ereg_replace($value[0], "<p style='color: #0c05fb; margin: 0;'>$value[0]</p>", $text);

                        if (Str::endsWith($surname, 'ը') || Str::endsWith($surname, 'ի')) {
                            $surname = Str::substr($surname, 0, -1);
                        }
                        if (mb_substr($surname, -2, 2, 'UTF-8') == 'ից' || mb_substr($surname, -2, 2, 'UTF-8') == 'ին') {
                            $surname = Str::substr($surname, 0, -2);
                        }
                        $dataToInsert[] = [
                            'name' => $value[2],
                            'surname' => $surname,
                            'patronymic' => $patronymic,
                            'birthday' => $value[5],
                            'birth_day' => $birthDay,
                            'birth_month' => $birthMonth,
                            'birth_year' => $birthYear,
                            'address' => $valueAddress,
                            'findText' => $value[0],
                            'paragraph' => $text,
                            'fileName' => $fileName
                        ];
                    }
                }
            }

            DataUpload::insert($dataToInsert);

        } else {
            return back()->with('error', 'Файл не был отправлен');
        }

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function showFileDetails($filename)
    {
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

        // if (Storage::exists($filePath)) {
        //    
        //     $text = $this->searchService->getDocContent($fullPath);
        //     // var_dump($text);
        //     // print_r($text);
        //     // '/^([Ա-Ֆ][ա-ֆևv]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև+)\s/ \d{2,}.\d{2,}.\d{2,}$/u';
        //     // $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)/u';
        //     //default pattern Anun Hayranun Azganun /20.05.1888
        //     $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/\d{2,}.\d{2,}.\d{2,}/u';
        //     //defapatternTwoult pattern Anun Hayranun? Azganun /20.05.1888 || /1885
        //     $patternTwo = '/([Ա-Ֆ][ա-ֆև]+)\s+(([Ա-Ֆ][ա-ֆև]+)\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.)?(\d{2,}.)?\d{2,}/u';
        //     //defapatternThree pattern Anun ev Anun azganun
        //     // $patternThree = '/([Ա-Ֆ][ա-ֆև]+)\s+ և + \s ([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)/u';
        //     $patternThree = '/\/(.+?)\//u';

        //     //defpatternfour get address
        //     $patternFour = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\\/(.+?)\/ /u';

        //     //good work
        //     $patternFive = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+[\/\d{2,}.\d{2,}.\d{2,}]\s*(.+?)\//u';
        //     //version two good work
        //     // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+[\/\d{2,}.\d{2,}.\d{2,}]\s*(.+?)բն\.[0-9]+ /u';
        //     // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+[\/\d{2,}.\d{2,}.\d{2,}]\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/)/u';
        //     // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | բն\.[0-9]+.\/.] | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
        //     // $patternSix = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | բն\.[0-9]+.\/.] | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
        //     // $patternSix = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.?\d{2,}.?\d{2,}?)\s*(.+?)\s*(բն\.[0-9]+. | բն\.[0-9]+.\/.] | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.))/u';
        //     $patternSeven = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.)?(\d{2,}.)?\d{2,}\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';


        //     $patternSix = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/((\d{2,}.)?(\d{2,}.)?\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
        //     $patternEight = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/((\d{2,}.)?(\d{2,}.)?\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';

        //     $patternTest = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?+\/((\d{2,}.)?(\d{2,}.)?\d{2,})\s*(.+?)\s*)(?:\s+բն\.)?/u';

        //     $patternKK ='/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/((\d{2,}.)?(\d{2,}.)?\d{2,})\s*(.+?)\//u';

        //     $parts =  explode("\t", $text);
        //     $textNewLines = implode("\n", $parts);
        //     // preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
        //     // preg_match_all($patternTwo, $text, $matchesTwo, PREG_SET_ORDER);
        //     var_dump($textNewLines);
        //     preg_match_all($patternSix, $textNewLines, $matchesFour, PREG_SET_ORDER);
        //     preg_match_all($patternTest, $textNewLines, $matchesThree, PREG_SET_ORDER);
        //     preg_match_all($patternKK, $textNewLines, $matchesKK, PREG_SET_ORDER);

        //     dd($matchesKK);


        //     return view('search.file-details', compact('content'));
        //     // return redirect()->route('fileShow', compact('content'));

        // } else {
        //     return 'File Not found.';
        // }



        $fileDetails = DataUpload::where('fileName', $filename)->get();

        return view('search.file-details', compact(['fileDetails', 'filename']));


    }

    public function destroyDetails($rowId)
    {
        DataUpload::destroy($rowId);

        return redirect()->back()->with('success', 'deleted');
    }

    public function editDetails($local, $id)
    {
        $details = DataUpload::find($id);

        return view('search.edit-details', compact('details'));
    }

    public function updateDetails(Request $request, $local, $id)
    {
       $details = $this->searchService->updateDetails($request->all(), $id);

        return redirect()->route('file.details', ['locale' => app()->getLocale(), 'filename' => $details->fileName])
            ->with('success', 'Row updated successfully');
    }

    public function editDetailItem(Request $request, $id)
    {
        $this->searchService->editDetailItem($request->all(), $id);

        return response()->json(['message' => "Edited Succesfully"]);
    }

    public function showAllDetails()
    {
        $fileDetails = $this->searchService->showAllDetails();

        return view('search.all-details', compact('fileDetails'));
    }

    public function showAllDetailsDoc($lang, $filename)
    {
        $implodeArray = $this->searchService->showAllDetailsDoc($filename);

        return view('search.show-word', compact('implodeArray'));
    }
}