<?php
namespace Services;

use PhpOffice\PhpWord\IOFactory;

class WordFileReaderService
{
    public static function read_word($fullPath){
        $phpWord = IOFactory::load($fullPath);
        $sections = $phpWord->getSections();
        // dd($sections);
        foreach ($sections as $key => $value) {

        }
    }

}
