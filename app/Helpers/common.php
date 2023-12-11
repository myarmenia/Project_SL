<?php

use App\Models\Man\Man;
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

function convertDocToDocx($inputPath, $outputPath)
{
    $command = "libreoffice --headless --convert-to docx --outdir $outputPath $inputPath";

    $result = shell_exec($command);

    info('convertDocToDocx', [$result, $inputPath, $outputPath]);

    if ($result) {
        return true;
    } else {
        return false;
    }

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

    if ($date = (string)$date) {
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
        $readyYear = (int)$getLastTwoNumberInCarbonNow < (int)$year ? '19' . $year : '20' . $year;
        return $readyYear;
    }

    return $year;
}

function getSearchMan($fullNameArr)
{

    $searchTermName = $fullNameArr['first_name'];
    $searchTermSurname = $fullNameArr['last_name'];
    $searchTermPatronymic = $fullNameArr['middle_name'];
    $searchTermFullName = $fullNameArr['full_name'];
    $allColumnSearch = true;

    if($searchTermFullName){
        $searchTermName = $searchTermFullName;
        $allColumnSearch = false;
    }

    $searchDegree = config("constants.search.STATUS_SEARCH_DEGREE");

    $getLikeManIds = DB::table('man')
        ->whereExists(function ($query) use ($searchTermName, $searchDegree) {
            if($searchTermName){
                $query->select(DB::raw(1))
                    ->from('first_name')
                    ->join('man_has_first_name', 'first_name.id', '=', 'man_has_first_name.first_name_id')
                    ->whereColumn('man.id', 'man_has_first_name.man_id')
                    ->whereRaw("LEVENSHTEIN(first_name, ?) <= ?", [$searchTermName, $searchDegree]);
            }

        })
        ->whereExists(function ($query) use ($searchTermSurname, $searchDegree, $allColumnSearch) {
            if($allColumnSearch && $searchTermSurname){
                $query->select(DB::raw(1))
                    ->from('last_name')
                    ->join('man_has_last_name', 'last_name.id', '=', 'man_has_last_name.last_name_id')
                    ->whereColumn('man.id', 'man_has_last_name.man_id')
                    ->whereRaw("LEVENSHTEIN(last_name, ?) <= ?", [$searchTermSurname, $searchDegree]);
            }
        })
        ->whereExists(function ($query) use ($searchTermPatronymic, $searchDegree, $allColumnSearch) {
            if ($allColumnSearch && $searchTermPatronymic) {
                $query->select(DB::raw(1))
                    ->from('middle_name')
                    ->join('man_has_middle_name', 'middle_name.id', '=', 'man_has_middle_name.middle_name_id')
                    ->whereColumn('man.id', 'man_has_middle_name.man_id')
                    ->whereRaw("LEVENSHTEIN(middle_name, ?) <= ?", [$searchTermPatronymic, $searchDegree]);
            }
        })
        ->pluck('id');

    // $getLikeMan = Man::whereIn("id", $getLikeManIds)
    //     ->with("firstName", "lastName", "middleName", "firstName1", "lastName1", "middleName1")
    //     ->get();

    return $getLikeManIds;
}


function getDbManByIds($ids)
{
    $getLikeMan = Man::whereIn("id", $ids)
        ->with("firstName", "lastName", "middleName", "firstName1", "lastName1", "middleName1")
        ->get();

    return $getLikeMan;
}

function getDateRange(string $reportRange, string $year, string $startDate = null, string $endDate = null): array
{
    $from = $to = null;
    switch ($reportRange) {
        case 'half_year_1':
            $from = \Illuminate\Support\Carbon::create($year)->startOfYear()->toDateString();
            $to = Carbon::create($year)->addMonths(5)->endOfMonth()->toDateString();
            break;
        case 'half_year_2':
            $from = Carbon::create($year)->addMonths(6)->startOfMonth()->toDateString();
            $to = Carbon::create($year)->endOfYear()->endOfMonth()->toDateString();
            break;
        case 'quarter_1':
            $from = Carbon::create($year)->startOfYear()->toDateString();
            $to = Carbon::create($year)->addMonths(2)->endOfMonth()->toDateString();
            break;
        case 'quarter_2':
            $from = Carbon::create($year)->addMonths(3)->startOfMonth()->toDateString();
            $to = Carbon::create($year)->addMonths(5)->endOfMonth()->toDateString();
            break;
        case 'quarter_3':
            $from = Carbon::create($year)->addMonths(6)->startOfMonth()->toDateString();
            $to = Carbon::create($year)->addMonths(8)->endOfMonth()->toDateString();
            break;
        case 'quarter_4':
            $from = Carbon::create($year)->addMonths(9)->startOfMonth()->toDateString();
            $to = Carbon::create($year)->endOfYear()->endOfMonth()->toDateString();
            break;
        case 'year':
            $from = Carbon::create($year)->startOfYear()->toDateString();
            $to = Carbon::create($year)->endOfYear()->endOfMonth()->toDateString();
            break;
        case 'other':
            $from = Carbon::createFromFormat('Y-m-d', $startDate)->toDateString();
            $to = Carbon::createFromFormat('Y-m-d', $endDate)->toDateString();
            break;
    }


    return compact('from', 'to');
}

