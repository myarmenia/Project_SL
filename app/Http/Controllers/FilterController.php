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

                // $data = array_map(function ($key, $new_arr) use ($table_name) {

                //     $search_name = 'name';


                //     // if ($key == 'passport') {
                //     //     $search_name = 'number';
                //     // } else if ($key == 'first_name' || $key == 'last_name' || $key == 'middle_name') {
                //     //     $search_name = $new_arr;
                //     // } else if ($key == 'more_data') {
                //     //     $search_name = 'text';
                //     // } else if ($key == 'material_content') {
                //     //     $search_name = 'content';
                //     // } else if ($key == 'worker') {
                //     //     $search_name = 'worker';
                //     // } else {
                //     //     $search_name = 'name';
                //     // }

                //     $returned_value = '';

                //     if (is_array($new_arr) && !empty($new_arr)) {

                //         $first_element = reset($new_arr);
                //         if (is_array($first_element)) {
                //             $returned_value = implode(' ', array_column($new_arr,  $search_name));
                //         } else {
                //             $returned_value = $new_arr[$search_name];
                //         }
                //     } else {
                //         $returned_value = !empty($new_arr) ? $new_arr : null;
                //     }

                //     return $returned_value;
                // }, array_keys($new_arr), array_values($new_arr));

                $esim_e = [];

                array_walk($new_arr, function ($value, $key) use (&$esim_e) {

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

                        $first_element = reset($value);
                        if (is_array($first_element)) {
                            $returned_value = implode(' ', array_column($value,  $search_name));
                        } else {
                            $returned_value = $value[$search_name];
                        }
                    } else {
                        $find_text = str_contains($key, 'date');

                        if ($find_text) {
                            $value = date('d-m-Y', strtotime($value));
                        }
                        $returned_value = !empty($value) ? $value : null;
                    }

                    $esim_e[$key] = $returned_value;
                });

                $sortedArray = array_merge(array_flip($model->relationColumn), $esim_e);

                array_push($finish_data, $sortedArray);

                dd($finish_data);
            }


            return response()->json($finish_data);
        } else {
        }
    }

    // public function aaaa() {

    //     $rel_model = self::get_model_class($key)->where($id, $value[$id])->first();

    //     $relation_fields['fields'] = $rel_model->relation_field() ?? null;

    // }
}
