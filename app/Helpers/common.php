<?php 

use PhpOffice\PhpWord\IOFactory;

function getDocContent($fullPath)
{
    $phpWord = IOFactory::load($fullPath);
    $content = '';
    $sections = $phpWord->getSections();

    foreach ($sections as $section) {
        foreach ($section->getElements() as $element) {
            if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                foreach ($element->getElements() as $textElement) {
                    if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                        $content .= $textElement->getText() . '';
                    }
                }
            }
        }
    }
    return $content;
}

