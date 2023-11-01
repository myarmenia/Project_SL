<?php

namespace App\Http\Controllers;

use App\Models\Man\Man;
use App\Services\Filter\DictionaryFilterService;
use App\Services\Relation\ModelRelationService;
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
            $model = ModelRelationService::get_model_class($table_name);

            $result = $model
                ->filter($request->all())
                ->with('character')
                ->paginate(10)->toArray();

            $new_arr = array_intersect_key($result['data'], array_flip($model->relationColumn));

            // $data = array_map(function ($new_arr) {
            //     return is_array($new_arr) ? $new_arr['k'] : $new_arr;
            // }, $new_arr);

            dd($new_arr);
        } else {
        }

        return response()->json($result);
    }

    // public function aaaa() {

    //     $rel_model = self::get_model_class($key)->where($id, $value[$id])->first();

    //     $relation_fields['fields'] = $rel_model->relation_field() ?? null;

    // }
}
