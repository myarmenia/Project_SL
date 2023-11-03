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

                $finsih_array = [];

                array_walk($new_arr, function ($value, $key) use (&$finsih_array) {

                    $search_name = '';

                    if ($key == 'material_content') {
                        $search_name = 'content';
                    } else if ($key == 'worker') {
                        $search_name = 'worker';
                    } else {
                        $search_name = 'name';
                    }


                    $returned_value = '';

                    if (is_array($value) && !empty($value)) {


                        $find_text_count = str_contains($key, 'count');

                        if ($find_text_count) {
                            $returned_value = count($value);
                        } else {

                            $first_element = reset($value);

                            if (is_array($first_element)) {
                                $returned_value = implode(' ', array_column($value,  $search_name));
                            } else {
                                $returned_value = $value[$search_name];
                            }
                        }
                    } else {

                        $find_text_date = str_contains($key, 'date');

                        if ($find_text_date) {
                            $value = date('d-m-Y', strtotime($value));
                        }

                        $returned_value = !empty($value) ? $value : null;
                    }

                    $finsih_array[$key] = $returned_value;
                });

                $sortedArray = array_merge(array_flip($model->relationColumn), $finsih_array);

                array_push($finish_data, $sortedArray);
            }


            return response()->json($finish_data);
        }
    }

    // public function aaaa() {

    //     $rel_model = self::get_model_class($key)->where($id, $value[$id])->first();

    //     $relation_fields['fields'] = $rel_model->relation_field() ?? null;

    // }
}
