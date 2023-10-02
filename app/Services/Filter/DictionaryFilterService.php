<?php

namespace App\Services\Filter;

use Dotenv\Util\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DictionaryFilterService
{

    public static function filter($name, $sort, $table_name, $actions)
    {

        $result = DB::table($table_name)->where('id', '>', 0);

        $action = null;
        $value = null;

        if($actions != null) {
            foreach($actions as $act) {
                $action = str_replace('-', $act['value'], $act['action']);
                $result = $result->where($name, 'like', $action);
            }
        }

        if($sort != 'null') {
            $result = $result->orderBy($name, $sort);
        }

        $result = $result->paginate(1);

        return $result;

    }
}
