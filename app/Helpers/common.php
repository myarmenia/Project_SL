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

function differentFirstLetterHelper($manCompare, $itemCompare, $generalProcent, $key = null)
{
    similar_text($manCompare, $itemCompare, $procent);

    if ($procent <= $generalProcent) {
        return false;
    }

    return $procent;
}

function addManRelationsData($man)
{
    $man->name = $man->firstName ? $man->firstName->first_name : "";
    $man->surname = $man->lastName ? $man->lastName->last_name : "";
    $man->patronymic = $man->middleName ? $man->middleName->middle_name : "";
    $man->birthday = $man->birthday_str;
    return $man;
}

