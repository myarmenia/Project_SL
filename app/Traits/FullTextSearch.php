<?php

namespace App\Traits;

trait FullTextSearch
{
    protected function fullTextWildcards($term)
    {
        $reservedSymbols = ['*','?','+','-', '<', '>', '@', '(', ')', '~'];

        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            if (strlen($word) >= 3) {
                $words[$key] = "{$word}*";
            }
        }

        return implode(' ', $words);
    }

    public function search(array $columns,?string $term,int $distance)
    {
        $cols = $columns;

        $columns = collect($columns)->map(function ($column) {
            return $column;
        })->implode(',');

        $sear = $this->fullTextWildcards($term);

        if (strpos($term,'+') !== false) {

            $query = " AND MATCH ({$columns}) AGAINST ('$sear' IN BOOLEAN MODE)";
        }
        else{

            $reservedSymbols = ['*','?','-', '+', '<', '>', '@', '(', ')', '~'];
            $term = str_replace($reservedSymbols, '', $term);

            $query = " AND MATCH ({$columns}) AGAINST ('$sear' IN BOOLEAN MODE)";

            if (count($cols) > 1) {

                foreach ($cols as $col) {

                    $query .=  " OR LEVENSHTEIN($col, '$term') <= ".$distance;
                }
            }else{
                $query .=  " OR LEVENSHTEIN({$columns}, '$term') <= ".$distance;
            }

        }

        return $query;
    }
}
