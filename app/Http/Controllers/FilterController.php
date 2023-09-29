<?php

namespace App\Http\Controllers;

use App\Services\Filter\DictionaryFilterService;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        dd($request->all());
        $input = $request->all();
        foreach ($input as $data) {

            if ($data['section_name'] == 'dictionary') {
                $name = $data['name'];
                $sort = $data['sort'];
                $table_name = $data['table_name'];
                DictionaryFilterService::filter($name, $sort, $table_name);
            }
        }
    }
}
