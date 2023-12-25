<?php

namespace App\Traits;

use App\Services\LearningSystemService;
use App\Services\SearchService;


trait FullTextSearch
{
    function transl(LearningSystemService $learningSystemService, $content)
    {
        return $learningSystemService->get_info($content);
    }
    function arifDateString(array $data): string
    {
        $query = '';

        $query = match ($data['date_search_arif']) {
            '=' => " AND {$data['search_col']} LIKE '%{$data['search_date']}%'",
            '!=' => " AND {$data['search_col']}  NOT LIKE '%{$data['search_date']}%'",
            '>' => " AND STR_TO_DATE({$data['search_col']} , '%d-%m-%Y') > STR_TO_DATE('{$data['search_date']}','%d-%m-%Y')",
            '>=' => " AND STR_TO_DATE({$data['search_col']} , '%d-%m-%Y') >= STR_TO_DATE('{$data['search_date']}','%d-%m-%Y')",
            '<' => " AND STR_TO_DATE({$data['search_col']} , '%d-%m-%Y') < STR_TO_DATE('{$data['search_date']}','%d-%m-%Y')",
            '<=' => " AND STR_TO_DATE({$data['search_col']} , '%d-%m-%Y') <= STR_TO_DATE('{$data['search_date']}','%d-%m-%Y')",
            '<=>' => " AND STR_TO_DATE({$data['search_col']} , '%d-%m-%Y') BETWEEN  STR_TO_DATE('{$data['search_date']}','%d-%m-%Y') AND STR_TO_DATE('{$data['end_date']}','%d-%m-%Y')",

            default => " AND {$data['search_col']}  LIKE '%{$data['search_date']}%'"

        };

        return $query;
    }

    function arifDate(array $data): string
    {
        $query = '';

        $query = match ($data['date_search_arif']) {
            '=' => " AND {$data['search_col']} LIKE '%{$data['search_field']}%'",
            '!=' => " AND {$data['search_col']}  NOT LIKE '%{$data['search_field']}%'",
            '>' => " AND {$data['search_col']} > STR_TO_DATE('{$data['search_field']}','%Y-%d-%m')",
            '>=' => " AND {$data['search_col']} >= STR_TO_DATE('{$data['search_field']}','%Y-%d-%m')",
            '<' => " AND {$data['search_col']}  < STR_TO_DATE('{$data['search_field']}','%Y-%d-%m')",
            '<=' => " AND {$data['search_col']} <= STR_TO_DATE('{$data['search_field']}','%Y-%d-%m')",
            '<=>' => " AND {$data['search_col']} BETWEEN  '{$data['search_field']}' AND '{$data['end_date']}'",

            default => " AND {$data['search_col']}  LIKE '%{$data['search_date']}%'"

        };

        return $query;
    }

    function arifInt(array $data): string
    {
        $query = '';

        $query = match ($data['date_search_arif']) {

            '>' => " AND {$data['search_col']} > {$data['search_field']}",
            '>=' => " AND {$data['search_col']} >= {$data['search_field']}",
            '<' => " AND {$data['search_col']}  < {$data['search_field']}",
            '<=' => " AND {$data['search_col']} <= {$data['search_field']}",
            '<=>' => " AND {$data['search_col']} BETWEEN  {$data['search_field']} AND {$data['end_date']}",

            default => " AND {$data['search_col']} = {$data['search_date']}"

        };

        return $query;

    }

    protected function fullTextWildcards($term)
    {
        $reservedSymbols = ['?','-', '<', '>', '@', '(', ')', '~'];

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

        $columns = collect($columns)->map(function ($column) {
            return $column;
        })->implode(',');

        $sear = '"'.$this->fullTextWildcards($term).'"';

                if ($distance === 1) {
                    $query = " AND MATCH ({$columns}) AGAINST ('$sear' IN BOOLEAN MODE)";
                }
                else{
                    $reservedSymbols = ['*','?','-', '+', '<', '>', '@', '(', ')', '~','"'];
                    $term = str_replace($reservedSymbols, '', $term);

                    $query = "";

                    if (count($cols) > 1) {

                        foreach ($cols as $col) {

                            if (mb_strlen($term,'UTF-8') <= 6) {

                                $distance = 1;
                            }

                            $term = explode(' ',$term);
                            $query .=  " AND (LEVENSHTEIN({$col}, '$term[0]') <= ".$distance
                                        . " OR LEVENSHTEIN({$col}, '$term[1]') <= ".$distance
                                        . " OR LEVENSHTEIN({$col}, '$term[2]') <= ".$distance.")";
                        }
                    }else{
                        if (mb_strlen($term,'UTF-8') <= 6) {

                            $distance = 1;
                        }
                        $term = explode(' ',$term);
                        $query .=  " AND (LEVENSHTEIN({$columns}, '$term[0]') <= ".$distance
                                    . " OR LEVENSHTEIN({$columns}, '$term[1]') <= ".$distance
                                    . " OR LEVENSHTEIN({$columns}, '$term[2]') <= ".$distance.")";
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
