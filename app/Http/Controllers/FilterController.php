<?php

namespace App\Http\Controllers;

use App\Services\Filter\DictionaryFilterService;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter($page, Request $request)
    {
        $request['page'] = $page;

        $input = $request->all();

        $table_name = $input[0]['table_name'];
        $section_name = $input[0]['section_name'];
        $result = '';

        if($section_name == 'dictionary' || $section_name == 'translate') {
            $result = DictionaryFilterService::filter($input, $table_name, $page);
        }

        return response()->json($result);
    }
}
