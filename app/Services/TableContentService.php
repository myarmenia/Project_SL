<?php
namespace App\Services;

use PhpOffice\PhpWord\IOFactory;

class TableContentService {

    public function get($fullPath,$column_name){
        $column_name['number']-=1;
        $column_name['first_name']-=1;
        $column_name['last_name']-=1;
        $column_name['middle_name']-=1;
        $column_name['birthday']-=1;

        $phpWord = IOFactory::load($fullPath);
        $content = '';
        $row_content="";

        $sections = $phpWord->getSections();

        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {

                if ($element instanceof \PhpOffice\PhpWord\Element\Table) {

                    foreach ($element->getRows() as $data=>$rows) {

                        $cell=$rows->getCells();

                        foreach( $cell as $key=>$item ){
                            $cell_content='';
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
                        }

                        $content .='</hr>';

                    }
                }

            }

        }

        return $content;


    }

}

