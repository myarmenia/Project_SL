<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait FullTextSearch
{

    protected function fullTextWildcards($term)
    {
        $reservedSymbols = ['*','?','-', '<', '>', '@', '(', ')', '~'];

        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            if (strlen($word) >= 3) {
                    $words[$key] = "{$word}";
            }
        }

        return implode(' ', $words);
    }

    public function search(array $columns,?string $term,?int $distance = 2)
    {
        $cols = $columns;
        $distance = $distance ?? 2;

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

                            $query .=  " AND LEVENSHTEIN($col, '$term') <= ".$distance;
                        }
                    }else{
                        $query .=  " AND LEVENSHTEIN({$columns}, '$term') <= ".$distance;
                    }

                }

            return $query;
    }
}
