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

            return response()->json($result);
        } else if ($section_name == 'open') {
            $finish_data = [];
            $model = ModelRelationService::get_model_class($table_name);

            $result = $model
                ->filter($request->all())
                ->with($model->relation)
                ->paginate(10)->toArray();

            foreach ($result['data'] as $data) {
                $new_arr = array_intersect_key($data, array_flip($model->relationColumn));

                $data = array_map(function ($new_arr) {

                    $returned_value = '';

                    if (is_array($new_arr) && !empty($new_arr)) {
                        $first_element = reset($new_arr);
                        if (is_array($first_element)) {
                            $returned_value = implode(' ', array_column($new_arr, 'name'));
                        } else {
                            $returned_value = $new_arr['name'];
                        }
                    } else {
                        $returned_value = $new_arr;
                    }

                    return $returned_value;

                    // return is_array($new_arr) ? implode(' ', array_column($new_arr, 'name'))  : $new_arr;

                }, $new_arr);

                $sortedArray = array_merge(array_flip($model->relationColumn), $data);

                dd($sortedArray);

                array_push($finish_data, $data);
            }

            // dd($finish_data);

            return response()->json($finish_data);
        } else {
        }
    }

    // public function aaaa() {

    //     $rel_model = self::get_model_class($key)->where($id, $value[$id])->first();

    //     $relation_fields['fields'] = $rel_model->relation_field() ?? null;

    // }
}
