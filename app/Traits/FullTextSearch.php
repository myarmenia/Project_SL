<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait FullTextSearch
{
   /* public function searchBetweenWords(array $data)
    {
        $output = preg_replace('!\s+!', ' ', $data['search_between']);
        $word = explode(" ", $output);

        $d = "'\'";
        return DB::select(
            "select find_word.file_id, find_word.content FROM
           ( SELECT `file_id`,`content` FROM file_texts
             WHERE MATCH (content) AGAINST ('$word[0] word[1]' IN BOOLEAN MODE))
             AS find_word
             WHERE
             CHAR_LENGTH(
                REGEXP_REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(find_word.content66, ?,-1),?, 1),'\\\\s+',' ')) - CHAR_LENGTH(REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(find_word.content, ?,-1),?, 1), ' ', '')) - 1 = ?",

            [$word[0], $word[1], $word[0], $word[1], 4]
        );
    } */

    protected function fullTextWildcards($term)
    {
        $reservedSymbols = ['*','?','-', '<', '>', '@', '(', ')', '~'];

        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            if (strlen($word) >= 3) {
                if (strpos($word, '+') !== false) {
                    $word = str_replace('+', '', $word);
                    $words[$key] = "{$word}*";
                }else{
                    $words[$key] = "{$word}";
                }

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
