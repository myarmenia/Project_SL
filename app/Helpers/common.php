<?php

use PhpOffice\PhpWord\IOFactory;
use Carbon\Carbon;

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

function checkAndCorrectDateFormat($date)
{
                          
    if ($date = (string) $date) {
        if (strlen($date) == 4) {
            return $date;
        } else {
            $pattern = '/(\d{2,}).?(\d{2,}).?(\d{2,})/u';
            preg_match($pattern, $date, $parts);

            if (is_string($parts)) {
                return $parts;
            } else {
                $addedYear = addYearMissingPart($parts[3]);

                if ($parts[1] == "00" || $parts[2] == "00") {
                    return $addedYear;
                } elseif ($parts[1] != "00" && $parts[2] != "00") {
                    return $parts[1] . '.' . $parts[2] . '.' . $addedYear;
                }
            }

        }

    }
    return $date;
}

function addYearMissingPart($year)
{
    if ($year && strlen($year) == 2) {
        $getLastTwoNumberInCarbonNow = Carbon::now()->format('y');
        $readyYear = (int) $getLastTwoNumberInCarbonNow < (int) $year ? '19' . $year : '20' . $year;
        return $readyYear;
    }

    return $year;
}

