<?php

namespace App\Http\Controllers;

use App\Services\Filter\DictionaryFilterService;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        $input = $request->all();

        foreach ($input as $data) {
            if ($data['section_name'] == 'dictionary') {
                $name = $data['name'];
                $sort = $data['sort'];
                $table_name = $data['table_name'];
                $actions = null;

                if (isset($data['actions'])) {
                    $actions = $data['actions'];
                }

                $result = DictionaryFilterService::filter($name, $sort, $table_name, $actions);
            }
        }

        return response()->json(['data' => $result]);
    }
}
