<?php

namespace App\Services\Filter;

use App\Models\TempTables\TmpManFindText;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadDictionaryFilterService
{

    public static function filter($input, $fileName)
    {

        // $selected_fields = [];

        $result = TmpManFindText::with([
            'man.firstName1',
            'man.lastName1',
            'man.middleName1',
            'getApprovedMan.firstName',
            'getApprovedMan.lastName',
            'getApprovedMan.middleName'
        ])->with('man')->where("file_name", $fileName);

        $action = null;
        $value = null;

        $sort_array = array_filter($input, function ($value) {
            return is_array($value) ? $value['sort'] !== 'null' : null;
        });

        foreach ($input as $key=>$data) {
            if (is_array($data)) {

                $name = $key;
                if (isset($data['actions'])) {
                    foreach ($data['actions'] as $act) {
                        $action = str_replace('-', $act['value'], $act['action']);
                        $result = $result->where($name, 'like', $action);
                    }
                }
                // array_push($selected_fields, $name);
            }
        }

        if (count($sort_array) == 1) {
            foreach ($sort_array as $key => $value) {
            if ($key == 'find_man_id') {
                $result = $result->orderBy('find_man_id', strtoupper($value["sort"]));
            }
             else {
                 $result = $result->orderBy($key, $value['sort']);
            }
        }
    } else {
            $result = $result->orderBy('id', 'desc');
        }

        $result = $result->get();

        return $result;
    }

}
