<?php
namespace App\Services;

use PhpOffice\PhpWord\IOFactory;

class TableContentService {

    public function get($fullPath){

        $phpWord = IOFactory::load($fullPath);
        $content = '';

        $sections = $phpWord->getSections();

        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {

                if ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                    foreach ($element->getRows() as $rows) {

                        $cell=$rows->getCells();
                        // dd($cell);
                        // dd($cell[1]->getElements()[0]->getElements()[0]->getText());
                        foreach($cell as $item){

                            if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextRun ){
                                // dd($item->getElements()[0] );
                                if($item->getwidth()>1000){
                                      // dd($item->getElements()[0]->getElements()[0]->getText());
                                    $content .=$item->getElements()[0]->getElements()[0]->getText().'<br>';

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

