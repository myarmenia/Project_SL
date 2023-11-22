<?php

namespace App\Services;

use App\Models\Man\Man;
use Illuminate\Support\Facades\DB;

class SearchItemsInFileService {

    public  function checkDataToInsert($dataToInsert){
// dd($dataToInsert);
        foreach ($dataToInsert as $item) {
            $searchTermName = $item["name"];
            $searchTermSurname = $item["surname"];

            // if()
            $getLikeMan = $this->getSearchMan($searchTermName, $searchTermSurname);

         }

    }


    public function getSearchMan($searchTermName, $searchTermSurname)
    {
    //    dd($searchTermName);
        $searchDegree = config("constants.search.STATUS_SEARCH_DEGREE");
// dd($searchDegree);
        $getLikeManIds = DB::table('man')
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
        ->get()->pluck('id');

        $getLikeMan = Man::whereIn("id", $getLikeManIds)
                ->with("firstName1", "lastName1", "middleName1")
                ->get();
dd($getLikeMan);
        return $getLikeMan;
    }

}
