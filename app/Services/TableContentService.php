<?php
namespace App\Services;

use App\Models\FirstName;
use App\Models\LastName;
use App\Models\Man;
use App\Models\MiddleName;
use PhpOffice\PhpWord\IOFactory;
use UConverter;

class TableContentService {

    public function get($fullPath,$column_name){
        $column_name['number']-=1;
        $column_name['first_name']-=1;
        $column_name['last_name']-=1;
        $column_name['middle_name']-=1;
        $column_name['birthday']-=1;

        // $phpWord = IOFactory::load($fullPath);
        $phpWord = IOFactory::load($fullPath,  'MsDoc');

        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor($filePath);
        $phpWord->save('example.docx');

        // $fontStyleName = 'oneUserDefinedStyle';
        // $phpWord->addFontStyle($fontStyleName, array('name' => 'DejaVu Sans', 'size' => 10));
// $phpWord->setDefaultFontName('DejaVu Sans, sans-serif');


// dd($phpWord->getDefaultFontName());
// $phpWord->setName('DejaVu Sans');
// $phpWord->setFontStyle($fontStyle);
// $phpWord->addFontStyle($fontStyleName, array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true));
        // $phpWord->setFontFamily('DejaVu Sans');
        // $phpWord->setLocale('hy');
        $content = '';
        $row_content="";

        $sections = $phpWord->getSections();
        // dd($sections);

        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {
                // $utf16_string = UConverter::transcode($element->getText(), 'UTF-16BE', 'UTF-8');
dd(iconv(mb_detect_encoding($element->getText(), mb_detect_order(), true), "UTF-8", $element->getText()));
// dd(iconv("UTF-8", "ISO-8859-1//TRANSLIT", $element->getText()), PHP_EOL);
                if ($element instanceof \PhpOffice\PhpWord\Element\Table) {

                    foreach ($element->getRows() as $data=>$rows) {

                        $cell=$rows->getCells();

                        foreach( $cell as $key=>$item ){

                            $key_name = '';

                                if($key==$column_name['number']){
                                    $key_name = 'number';
                                }
                                if($key==$column_name['first_name']){
                                    $key_name = 'first_name';
                                }
                                if($key==$column_name['last_name']){
                                    $key_name = 'last_name';
                                }
                                if($key==$column_name['middle_name']){
                                    $key_name = 'middle_name';
                                }
                                if($key==$column_name['birthday']){
                                    $key_name = 'birthday';
                                }

                            if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextRun ){
                                $content .='/'.$key_name.'/'.$item->getElements()[0]->getElements()[0]->getText().'/'.$key_name;


                            }
                            if($data!=0){
                                if($key==$column_name['last_name']){

                                $id =  LastName::addLastName($item->getElements()[0]->getElements()[0]->getText());

                                }
                                if($key==$column_name['first_name']){
                                    $id =  FirstName::addFirstName($item->getElements()[0]->getElements()[0]->getText());

                                }
                                if($key==$column_name['middle_name']){
                                    $id =  MiddleName::addMiddleName($item->getElements()[0]->getElements()[0]->getText());
                                }
                                if($key==$column_name['birthday']){

                                    $birthday_data = $item->getElements()[0]->getElements()[0]->getText();
                                    $explode_data=explode('.',$birthday_data);

                                    if(count(intval($explode_data[0]))>3){
                                        dd(789);
                                    }
                                    $id=Man::addUser($item->getElements()[0]->getElements()[0]->getText());

                                }
                            }

                        }

                        $content .='</hr>';

                    }
                }

            }

        }

        return $content;


    }

}

