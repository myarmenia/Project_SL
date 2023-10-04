<?php

namespace App\Services\Filter;

use Dotenv\Util\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DictionaryFilterService
{

    public static function filter($input, $table_name)
    {

        $result = DB::table($table_name)->where('id', '>', 0);

        $action = null;
        $value = null;

        $sort_array = array_filter($input, function ($value) {
            return $value['sort'] !== 'null';
        });

        foreach ($input as $data) {
            $name = $data['name'];
            $sort = $data['sort'];
            $actions = null;

            if (isset($data['actions'])) {
                foreach ($data['actions'] as $act) {
                    $action = str_replace('-', $act['value'], $act['action']);
                    $result = $result->where($name, 'like', $action);
                }
            }

        }

        if (count($sort_array) == 1) {
            $result = $result->orderBy(reset($sort_array)['name'], reset($sort_array)['sort']);
        } else {
            $result = $result->orderBy('id', 'desc');
        }

        $result = $result->get();

        return $result;

    }
}
