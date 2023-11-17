<?php

namespace App\Services;

use App\Services\Log\LogService;
use Illuminate\Support\Facades\DB;

class PoliceSearchService
{


    public function searchPolice($data)
    {
        $name = "";
        $surname = "";
        $patronymic = "";

        if($data['fullName']){
            $fullNameArr = explode( ' ', $data['fullName']);
            $surname = isset($fullNameArr[0])?$fullNameArr[0]:null;
            $name = isset($fullNameArr[1])?$fullNameArr[1]:null;
            $patronymic = isset($fullNameArr[2])?$fullNameArr[2]:null;
        } else{
            $surname = $data['lastName'];
            $name = $data['name'];
            $patronymic = $data['middleName'];
        }

        $getLikeMan = $this->getSearchMan($name, $surname, $patronymic);

        LogService::store($data, null, 'man', 'search');

        return $getLikeMan > 0? __('content.yes'): __('content.no');
    }

    public function getSearchMan($searchTermName, $searchTermSurname, $searchTermPatronymic)
    {
        $searchDegree = config("constants.search.STATUS_SEARCH_DEGREE");

        $getLikeManCount = DB::table('man')
        ->whereExists(function ($query) use ($searchTermName,  $searchDegree) {
            $query->select(DB::raw(1))
                ->from('first_name')
                ->join('man_has_first_name', 'first_name.id', '=', 'man_has_first_name.first_name_id')
                ->whereColumn('man.id', 'man_has_first_name.man_id')
                ->whereRaw("LEVENSHTEIN(first_name, ?) <= ?", [$searchTermName, $searchDegree]);
        })
        ->whereExists(function ($query) use ($searchTermSurname, $searchDegree) {
            $query->select(DB::raw(1))
                ->from('last_name')
                ->join('man_has_last_name', 'last_name.id', '=', 'man_has_last_name.last_name_id')
                ->whereColumn('man.id', 'man_has_last_name.man_id')
                ->whereRaw("LEVENSHTEIN(last_name, ?) <= ?", [$searchTermSurname, $searchDegree]);
        })
        ->whereExists(function ($query) use ($searchTermPatronymic, $searchDegree) {
            if ($searchTermPatronymic) {
                $query->select(DB::raw(1))
                    ->from('middle_name')
                    ->join('man_has_middle_name', 'middle_name.id', '=', 'man_has_middle_name.middle_name_id')
                    ->whereColumn('man.id', 'man_has_middle_name.man_id')
                    ->whereRaw("LEVENSHTEIN(middle_name, ?) <= ?", [$searchTermPatronymic, $searchDegree]);
            }
        })
        ->count();

        // $getLikeMan = Man::whereIn("id", $getLikeManIds)
        //         ->with("firstName", "lastName", "middleName")
        //         ->get();

        return $getLikeManCount;
    }
}
