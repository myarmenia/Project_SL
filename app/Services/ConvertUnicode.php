<?php


namespace App\Services;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Illuminate\Support\Str;

class ConvertUnicode
{
    public  static function upload($wordFile)
    {
        Settings::setDefaultFontName('Arial LatArm');
        // Settings::setDefaultFontName('Sylfaen');

        if ($wordFile) {
            //            $wordFile = $request->file('file');

            if ($wordFile->getClientOriginalExtension() === 'docx') {
                $phpWord = IOFactory::load($wordFile);


                // Get all sections in the document
                $sections = $phpWord->getSections();

                // Iterate through each section to remove table borders
                foreach ($sections as $section) {
                    $elements = $section->getElements();

                    // Iterate through elements in the section
                    foreach ($elements as $element) {
                        // Check if the element is a table
                        if ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                            $rows = $element->getRows();

                            // Iterate through rows
                            foreach ($rows as $row) {
                                $cells = $row->getCells();

                                // Iterate through cells to remove borders
                                foreach ($cells as $cell) {
                                    // Access cell properties and remove the border
                                    $cellStyle = $cell->getStyle();
                                    $cellStyle->setBorderTopSize(0);
                                    $cellStyle->setBorderRightSize(0);
                                    $cellStyle->setBorderBottomSize(0);
                                    $cellStyle->setBorderLeftSize(0);
                                }
                            }
                        }
                    }
                }

                $wordFile = Str::random(10) . '.docx';
                $newFilePath = storage_path('app/word-convert/New-' . $wordFile);
                $phpWord->save($newFilePath);
                //                dd($phpWord);

                //                return redirect()->back();
            } else {
                return "Please upload a .docx file.";
            }
        } else {
            return "No file was uploaded.";
        }
    }
}
