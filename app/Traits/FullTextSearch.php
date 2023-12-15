<?php

namespace App\Traits;

use App\Models\FirstName;
use App\Services\SearchService;


trait FullTextSearch
{
    protected function fullTextWildcards($term)
    {
        $reservedSymbols = ['?','-', '<', '>', '@', '(', ')', '~'];

        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            if (strlen($word) >= 3) {
                    $words[$key] = "{$word}*";
            }
        }

        return implode(' ', $words);
    }

    public function search(array $columns,?string $term,?int $distance = 2)
    {
        $cols = $columns;

        $columns = collect($columns)->map(function ($column) {
            return $column;
        })->implode(',');

        $sear = $this->fullTextWildcards($term);
                if ($distance === 1) {
                    $query = " AND MATCH ({$columns}) AGAINST ('$sear' IN BOOLEAN MODE)";
                }
                else{

                    $reservedSymbols = ['*','?','-', '+', '<', '>', '@', '(', ')', '~'];
                    $term = str_replace($reservedSymbols, '', $term);

                    $query = "";

                    if (count($cols) > 1) {

                        foreach ($cols as $col) {

                            if (mb_strlen($term,'UTF-8') <= 6) {

                                $distance = 1;
                            }

                            $query .=  " AND LEVENSHTEIN($col, '$term') <= ".$distance;
                        }
                    }else{
                        if (mb_strlen($term,'UTF-8') <= 6) {

                            $distance = 1;
                        }
                        $query .=  " AND LEVENSHTEIN({$columns}, '$term') <= ".$distance;
                    }

                }

            return $query;
    }

    function soundArmenian($model,$searchInput,$col,SearchService $searchService)
    {
        $datas = $model::lazy();
        foreach ($datas as  $data)
        {
            if ( $searchService->soundExArmenian("{$searchInput}",$data->$col)) {

                $ids[] = $data->id;
            }
        }

        return $ids ?? '' ;
    }
}
