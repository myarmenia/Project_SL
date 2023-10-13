<?php

namespace App\Http\Controllers;

use App\Services\Filter\DictionaryFilterService;
use Illuminate\Database\Eloquent\Model;
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

        if ($section_name == 'dictionary' || $section_name == 'translate') {
            $result = DictionaryFilterService::filter($input, $table_name, $page);
        } else if ($section_name == 'open') {
           
            $result = app('App\Models\\' . ucfirst($table_name). '\\' . ucfirst($table_name))
            ->filter($request->all())
            ->get();

            dd($result);
        } else {
        }

        return response()->json($result);
    }
}
