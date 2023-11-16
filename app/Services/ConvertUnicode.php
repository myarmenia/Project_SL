<?php


namespace App\Services;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Illuminate\Support\Str;

class ConvertUnicode
{
    // public  static function upload($wordFile)
    // {
    //     Settings::setDefaultFontName('Arial LatArm');
    //     // Settings::setDefaultFontName('Sylfaen');

    //     if ($wordFile) {
    //         //            $wordFile = $request->file('file');

    //         if ($wordFile->getClientOriginalExtension() === 'docx') {
    //             $phpWord = IOFactory::load($wordFile);


    //             // Get all sections in the document
    //             $sections = $phpWord->getSections();

    //             // Iterate through each section to remove table borders
    //             foreach ($sections as $section) {
    //                 $elements = $section->getElements();

    //                 // Iterate through elements in the section
    //                 foreach ($elements as $element) {
    //                     // Check if the element is a table
    //                     if ($element instanceof \PhpOffice\PhpWord\Element\Table) {
    //                         $rows = $element->getRows();

    //                         // Iterate through rows
    //                         foreach ($rows as $row) {
    //                             $cells = $row->getCells();

    //                             // Iterate through cells to remove borders
    //                             foreach ($cells as $cell) {
    //                                 // Access cell properties and remove the border
    //                                 $cellStyle = $cell->getStyle();
    //                                 $cellStyle->setBorderTopSize(0);
    //                                 $cellStyle->setBorderRightSize(0);
    //                                 $cellStyle->setBorderBottomSize(0);
    //                                 $cellStyle->setBorderLeftSize(0);
    //                             }
    //                         }
    //                     }
    //                 }
    //             }

    //             $wordFile = Str::random(10) . '.docx';
    //             $newFilePath = storage_path('app/word-convert/New-' . $wordFile);
    //             $phpWord->save($newFilePath);
    //             //                dd($phpWord);

    //             //                return redirect()->back();
    //         } else {
    //             return "Please upload a .docx file.";
    //         }
    //     } else {
    //         return "No file was uploaded.";
    //     }
    // }
    // public function convertArm(array $stringArray)
    // {
    //     $convertedArray = [];

    //     foreach ($stringArray as $subArray) {
    //         $convertedSubArray = [];

    //         foreach ($subArray as $myString) {
    //             $characters = mb_str_split($myString, 1, 'UTF-8');
    //             $customFontText = '';

    //             foreach ($characters as $char) {

    //                 // Your switch statement logic here
    //                 switch ($char) {
    //                     case 'ª':
    //                         $customFontText .= '՝';
    //                         break;
    //                     case '¿':
    //                         $customFontText .= 'է';
    //                         break;
    //                     case 'Ã':
    //                         $customFontText .= 'թ';
    //                         break;
    //                     case '÷':
    //                         $customFontText .= 'փ';
    //                         break;
    //                     case 'Ó':
    //                         $customFontText .= 'ձ';
    //                         break;
    //                     case 'ç':
    //                         $customFontText .= 'ջ';
    //                         break;
    //                     case 'ô':
    //                         $customFontText .= 'Ւ';
    //                         break;
    //                     case '¨':
    //                         $customFontText .= 'և';
    //                         break;
    //                     case 'ñ':
    //                         $customFontText .= 'ր';
    //                         break;
    //                     case 'ã':
    //                         $customFontText .= 'չ';
    //                         break;
    //                     case '×':
    //                         $customFontText .= 'ճ';
    //                         break;


    //                     case 'ù':
    //                         $customFontText .= 'ք';
    //                         break;
    //                     case 'á':
    //                         $customFontText .= 'ո';
    //                         break;
    //                     case '»':
    //                         $customFontText .= 'ե';
    //                         break;
    //                     case 'é':
    //                         $customFontText .= 'ռ';
    //                         break;
    //                     case 'ï':
    //                         $customFontText .= 'տ';
    //                         break;
    //                     case 'Á':
    //                         $customFontText .= 'ը';
    //                         break;
    //                     case 'õ':
    //                         $customFontText .= 'ւ';
    //                         break;
    //                     case 'Ç':
    //                         $customFontText .= 'ի';
    //                         break;
    //                     case 'û':
    //                         $customFontText .= 'օ';
    //                         break;
    //                     case 'å':
    //                         $customFontText .= 'պ';
    //                         break;
    //                     case 'Ë':
    //                         $customFontText .= 'խ';
    //                         break;
    //                     case 'Í':
    //                         $customFontText .= 'ծ';
    //                         break;
    //                     case 'Å':
    //                         $customFontText .= 'ժ';
    //                         break;


    //                     case '³':
    //                         $customFontText .= 'ա';
    //                         break;
    //                     case 'ë':
    //                         $customFontText .= 'ս';
    //                         break;
    //                     case '¹':
    //                         $customFontText .= 'դ';
    //                         break;
    //                     case 'ý':
    //                         $customFontText .= 'ֆ';
    //                         break;
    //                     case '·':
    //                         $customFontText .= 'գ';
    //                         break;
    //                     case 'Ñ':
    //                         $customFontText .= 'հ';
    //                         break;
    //                     case 'Û':
    //                         $customFontText .= 'յ';
    //                         break;
    //                     case 'Ï':
    //                         $customFontText .= 'կ';
    //                         break;
    //                     case 'É':
    //                         $customFontText .= 'լ';
    //                         break;
    //                     case '°':
    //                         $customFontText .= '՛';
    //                         break;
    //                     case 'ß':
    //                         $customFontText .= 'շ';
    //                         break;


    //                     case '½':
    //                         $customFontText .= 'զ';
    //                         break;
    //                     case 'Õ':
    //                         $customFontText .= 'ղ';
    //                         break;
    //                     case 'ó':
    //                         $customFontText .= 'ց';
    //                         break;
    //                     case 'í':
    //                         $customFontText .= 'վ';
    //                         break;
    //                     case 'µ':
    //                         $customFontText .= 'բ';
    //                         break;
    //                     case 'Ý':
    //                         $customFontText .= 'ն';
    //                         break;
    //                     case 'Ù':
    //                         $customFontText .= 'մ';
    //                         break;

    //                         ///
    //                     case '¯':
    //                         $customFontText .= '՜';
    //                         break;
    //                     case '¾':
    //                         $customFontText .= 'Է';
    //                         break;
    //                     case 'Â':
    //                         $customFontText .= 'Թ';
    //                         break;
    //                     case 'ö':
    //                         $customFontText .= 'Փ';
    //                         break;
    //                     case 'Ò':
    //                         $customFontText .= 'Ձ';
    //                         break;
    //                     case 'æ':
    //                         $customFontText .= 'Ջ';
    //                         break;
    //                     case 'ô':
    //                         $customFontText .= 'Ւ';
    //                         break;
    //                     case '¨':
    //                         $customFontText .= 'և';
    //                         break;
    //                     case 'ð':
    //                         $customFontText .= 'Ր';
    //                         break;
    //                     case 'â':
    //                         $customFontText .= 'Չ';
    //                         break;
    //                     case 'Ö':
    //                         $customFontText .= 'Ճ';
    //                         break;
    //                     case 'Ä':
    //                         $customFontText .= 'Ժ';
    //                         break;

    //                     case 'ø':
    //                         $customFontText .= 'Ք';
    //                         break;
    //                     case 'à':
    //                         $customFontText .= 'Ո';
    //                         break;
    //                     case 'º':
    //                         $customFontText .= 'Ե';
    //                         break;
    //                     case 'è':
    //                         $customFontText .= 'Ռ';
    //                         break;
    //                     case 'î':
    //                         $customFontText .= 'Տ';
    //                         break;
    //                     case 'À':
    //                         $customFontText .= 'Ը';
    //                         break;
    //                     case 'ô':
    //                         $customFontText .= 'Ւ';
    //                         break;
    //                     case 'Æ':
    //                         $customFontText .= 'Ի';
    //                         break;
    //                     case 'ú':
    //                         $customFontText .= 'Օ';
    //                         break;
    //                     case 'ä':
    //                         $customFontText .= 'Պ';
    //                         break;
    //                     case 'Ê':
    //                         $customFontText .= 'Խ';
    //                         break;
    //                     case 'Ì':
    //                         $customFontText .= 'Ծ';
    //                         break;

    //                     case '²':
    //                         $customFontText .= 'Ա';
    //                         break;
    //                     case 'ê':
    //                         $customFontText .= 'Ս';
    //                         break;
    //                     case '¸':
    //                         $customFontText .= 'Դ';
    //                         break;
    //                     case 'ü':
    //                         $customFontText .= 'Ֆ';
    //                         break;
    //                     case '¶':
    //                         $customFontText .= 'Գ';
    //                         break;
    //                     case 'Ð':
    //                         $customFontText .= 'Հ';
    //                         break;
    //                     case 'Ú':
    //                         $customFontText .= 'Յ';
    //                         break;
    //                     case 'Î':
    //                         $customFontText .= 'Կ';
    //                         break;
    //                     case 'È':
    //                         $customFontText .= 'Լ';
    //                         break;
    //                     case '±':
    //                         $customFontText .= '՞';
    //                         break;
    //                     case 'Þ':
    //                         $customFontText .= 'Շ';
    //                         break;

    //                     case '¼':
    //                         $customFontText .= 'Զ';
    //                         break;
    //                     case 'Ô':
    //                         $customFontText .= 'Ղ';
    //                         break;
    //                     case 'ò':
    //                         $customFontText .= 'Ց';
    //                         break;
    //                     case 'ì':
    //                         $customFontText .= 'Վ';
    //                         break;
    //                     case '´':
    //                         $customFontText .= 'Բ';
    //                         break;
    //                     case 'Ü':
    //                         $customFontText .= 'Ն';
    //                         break;
    //                     case 'Ø':
    //                         $customFontText .= 'Մ';
    //                         break;
    //                     case '¦':
    //                         $customFontText .= 'ՙ';
    //                         break;
    //                     case '§':
    //                         $customFontText .= '՚';
    //                         break;
    //                     case '?':
    //                         $customFontText .= '?';
    //                         break;
    //                     default:
    //                         $customFontText .= $char;
    //                 }
    //             }

    //             $convertedSubArray[] = $customFontText;
    //         }

    //         $convertedArray[] = $convertedSubArray;
    //     }

    //     return $convertedArray;
    // }

    public static function convertArm( $myString)
    {

// dd($myString);

                $characters = mb_str_split($myString, 1, 'UTF-8');
                $customFontText = '';
                // dd($characters);
                foreach ($characters as $char) {

                    // Your switch statement logic here
                    switch ($char) {
                        case 'ª':
                            $customFontText .= '՝';
                            break;
                        case '¿':
                            $customFontText .= 'է';
                            break;
                        case 'Ã':
                            $customFontText .= 'թ';
                            break;
                        case '÷':
                            $customFontText .= 'փ';
                            break;
                        case 'Ó':
                            $customFontText .= 'ձ';
                            break;
                        case 'ç':
                            $customFontText .= 'ջ';
                            break;
                        case 'ô':
                            $customFontText .= 'Ւ';
                            break;
                        case '¨':
                            $customFontText .= 'և';
                            break;
                        case 'ñ':
                            $customFontText .= 'ր';
                            break;
                        case 'ã':
                            $customFontText .= 'չ';
                            break;
                        case '×':
                            $customFontText .= 'ճ';
                            break;


                        case 'ù':
                            $customFontText .= 'ք';
                            break;
                        case 'á':
                            $customFontText .= 'ո';
                            break;
                        case '»':
                            $customFontText .= 'ե';
                            break;
                        case 'é':
                            $customFontText .= 'ռ';
                            break;
                        case 'ï':
                            $customFontText .= 'տ';
                            break;
                        case 'Á':
                            $customFontText .= 'ը';
                            break;
                        case 'õ':
                            $customFontText .= 'ւ';
                            break;
                        case 'Ç':
                            $customFontText .= 'ի';
                            break;
                        case 'û':
                            $customFontText .= 'օ';
                            break;
                        case 'å':
                            $customFontText .= 'պ';
                            break;
                        case 'Ë':
                            $customFontText .= 'խ';
                            break;
                        case 'Í':
                            $customFontText .= 'ծ';
                            break;
                        case 'Å':
                            $customFontText .= 'ժ';
                            break;


                        case '³':
                            $customFontText .= 'ա';
                            break;
                        case 'ë':
                            $customFontText .= 'ս';
                            break;
                        case '¹':
                            $customFontText .= 'դ';
                            break;
                        case 'ý':
                            $customFontText .= 'ֆ';
                            break;
                        case '·':
                            $customFontText .= 'գ';
                            break;
                        case 'Ñ':
                            $customFontText .= 'հ';
                            break;
                        case 'Û':
                            $customFontText .= 'յ';
                            break;
                        case 'Ï':
                            $customFontText .= 'կ';
                            break;
                        case 'É':
                            $customFontText .= 'լ';
                            break;
                        case '°':
                            $customFontText .= '՛';
                            break;
                        case 'ß':
                            $customFontText .= 'շ';
                            break;


                        case '½':
                            $customFontText .= 'զ';
                            break;
                        case 'Õ':
                            $customFontText .= 'ղ';
                            break;
                        case 'ó':
                            $customFontText .= 'ց';
                            break;
                        case 'í':
                            $customFontText .= 'վ';
                            break;
                        case 'µ':
                            $customFontText .= 'բ';
                            break;
                        case 'Ý':
                            $customFontText .= 'ն';
                            break;
                        case 'Ù':
                            $customFontText .= 'մ';
                            break;

                            ///
                        case '¯':
                            $customFontText .= '՜';
                            break;
                        case '¾':
                            $customFontText .= 'Է';
                            break;
                        case 'Â':
                            $customFontText .= 'Թ';
                            break;
                        case 'ö':
                            $customFontText .= 'Փ';
                            break;
                        case 'Ò':
                            $customFontText .= 'Ձ';
                            break;
                        case 'æ':
                            $customFontText .= 'Ջ';
                            break;
                        case 'ô':
                            $customFontText .= 'Ւ';
                            break;
                        case '¨':
                            $customFontText .= 'և';
                            break;
                        case 'ð':
                            $customFontText .= 'Ր';
                            break;
                        case 'â':
                            $customFontText .= 'Չ';
                            break;
                        case 'Ö':
                            $customFontText .= 'Ճ';
                            break;
                        case 'Ä':
                            $customFontText .= 'Ժ';
                            break;

                        case 'ø':
                            $customFontText .= 'Ք';
                            break;
                        case 'à':
                            $customFontText .= 'Ո';
                            break;
                        case 'º':
                            $customFontText .= 'Ե';
                            break;
                        case 'è':
                            $customFontText .= 'Ռ';
                            break;
                        case 'î':
                            $customFontText .= 'Տ';
                            break;
                        case 'À':
                            $customFontText .= 'Ը';
                            break;
                        case 'ô':
                            $customFontText .= 'Ւ';
                            break;
                        case 'Æ':
                            $customFontText .= 'Ի';
                            break;
                        case 'ú':
                            $customFontText .= 'Օ';
                            break;
                        case 'ä':
                            $customFontText .= 'Պ';
                            break;
                        case 'Ê':
                            $customFontText .= 'Խ';
                            break;
                        case 'Ì':
                            $customFontText .= 'Ծ';
                            break;

                        case '²':
                            $customFontText .= 'Ա';
                            break;
                        case 'ê':
                            $customFontText .= 'Ս';
                            break;
                        case '¸':
                            $customFontText .= 'Դ';
                            break;
                        case 'ü':
                            $customFontText .= 'Ֆ';
                            break;
                        case '¶':
                            $customFontText .= 'Գ';
                            break;
                        case 'Ð':
                            $customFontText .= 'Հ';
                            break;
                        case 'Ú':
                            $customFontText .= 'Յ';
                            break;
                        case 'Î':
                            $customFontText .= 'Կ';
                            break;
                        case 'È':
                            $customFontText .= 'Լ';
                            break;
                        case '±':
                            $customFontText .= '՞';
                            break;
                        case 'Þ':
                            $customFontText .= 'Շ';
                            break;

                        case '¼':
                            $customFontText .= 'Զ';
                            break;
                        case 'Ô':
                            $customFontText .= 'Ղ';
                            break;
                        case 'ò':
                            $customFontText .= 'Ց';
                            break;
                        case 'ì':
                            $customFontText .= 'Վ';
                            break;
                        case '´':
                            $customFontText .= 'Բ';
                            break;
                        case 'Ü':
                            $customFontText .= 'Ն';
                            break;
                        case 'Ø':
                            $customFontText .= 'Մ';
                            break;
                        case '¦':
                            $customFontText .= 'ՙ';
                            break;
                        case '§':
                            $customFontText .= '՚';
                            break;
                        case '?':
                            $customFontText .= '?';
                            break;
                        default:
                            $customFontText .= $char;


            }



        }

        return $customFontText;
    }



}
