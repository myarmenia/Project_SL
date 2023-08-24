<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        // $photo->move(public_path('images/ProductImg'), $fileName);

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

        if (Storage::exists($filePath)) {
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

            // var_dump($text);
            // '/^([Ա-Ֆ][ա-ֆևv]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև+)\s/ \d{2,}.\d{2,}.\d{2,}$/u';
            // $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)/u';
            //default pattern Anun Hayranun Azganun /20.05.1888
            $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/\d{2,}.\d{2,}.\d{2,}/u';
            //defapatternTwoult pattern Anun Hayranun? Azganun /20.05.1888 || /1885
            $patternTwo = '/([Ա-Ֆ][ա-ֆև]+)\s+(([Ա-Ֆ][ա-ֆև]+)\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.)?(\d{2,}.)?\d{2,}/u';
            //defapatternThree pattern Anun ev Anun azganun
            // $patternThree = '/([Ա-Ֆ][ա-ֆև]+)\s+ և + \s ([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)/u';
            $patternThree = '/\/(.+?)\//u';

            //defpatternfour get address
            $patternFour = '/([Ա-Ֆ][ա-ֆև]+)\s+(([Ա-Ֆ][ա-ֆև]+)\s+)?([Ա-Ֆ][ա-ֆև]+)\s+\\/(.+?)\/ | ([Ա-Ֆ].[Ա-Ֆ][ա-ֆև]+)/u';
            // preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
            // preg_match_all($patternTwo, $text, $matchesTwo, PREG_SET_ORDER);
            // preg_match_all($patternThree, $text, $matchesThree, PREG_SET_ORDER);
            preg_match_all($patternFour, $text, $matchesFour, PREG_SET_ORDER);
            dd( $matchesFour);


            return view('search.file-details', compact('content'));
            // return redirect()->route('fileShow', compact('content'));

        } else {
            return 'File Not found.';
        }
    }
}