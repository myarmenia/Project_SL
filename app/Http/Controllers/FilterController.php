<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Services\Filter\DictionaryFilterService;
use App\Services\Relation\ModelRelationService;
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
        $final_look_arr = [];

        if ($section_name == 'dictionary' || $section_name == 'translate') {

            $result = DictionaryFilterService::filter($input, $table_name, $page);

            return response()->json($result);
        } else if ($section_name == 'open') {

            $finish_data = [];

            if (
                $table_name == 'sign'
            ) {
                $model_name = ucfirst('ManExternalSignHasSign');
                $model = app('App\Models\\' . $model_name);
            } else {
                $model = ModelRelationService::get_model_class($table_name);
            }

            $sort_array = array_filter($input, function ($value) {
                return is_array($value) ? $value['sort'] !== 'null' : null;
            });

            $result = $model
                ->filter($request->all())
                ->with($model->relation);


            if (count($sort_array) == 1) {
                $result = $result->orderBy(reset($sort_array)['name'], reset($sort_array)['sort']);
            } else {
                $result = $result->orderBy('id', 'desc');
            }

            $result = $result
                ->paginate(5)
                ->toArray();

            foreach ($result['data'] as $data) {
                if (isset($data['born_address'])) {
                    $address_relations = Address::with('country_ate', 'region', 'locality')->first();
                    $data['countryAte'] = $address_relations->country_ate->name;
                    $data['region'] = $address_relations->region->name;
                    $data['locality'] = $address_relations->locality->name;
                } else {
                    $data['countryAte'] = null;
                    $data['region'] = null;
                    $data['locality'] = null;
                }

                $new_arr = array_intersect_key($data, array_flip($model->relationColumn));

                $finsih_array = [];

                array_walk($new_arr, function ($value, $key) use (&$finsih_array) {

                    $search_name = '';

                    if ($key == 'material_content') {
                        $search_name = 'content';
                    } else if ($key == 'worker') {
                        $search_name = 'worker';
                    } else if ($key == 'first_name' || $key == 'last_name' || $key == 'middle_name') {
                        $search_name = $key;
                    } else if ($key == 'passport') {
                        $search_name = 'number';
                    } else if ($key == 'more_data') {
                        $search_name = 'text';
                    } else if ($key == 'user') {
                        $search_name = 'username';
                    } else {
                        $search_name = 'name';
                    }

                    $returned_value = '';

                    if (is_array($value) && !empty($value)) {

                        $find_text_count = str_contains($key, '_count1');
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

                        if ($find_text_date || $key == 'created_at') {
                            $value = date('d-m-Y', strtotime($value));
                        }

                        // $returned_value = !empty($value) ? $value : null;

                        if ($key == 'files_count1') {
                            $returned_value = count($value);
                        } else {
                            $returned_value = is_array($value) ? (!empty($value) ? $value : null) : $value;
                        }
                    }

                    $finsih_array[$key] = $returned_value;
                });

                $sortedArray = array_merge(array_flip($model->relationColumn), $finsih_array);

                $finish_data['current_page'] = $result['current_page'];
                $finish_data['last_page'] = $result['last_page'];


                array_push($final_look_arr, $sortedArray);
            }

            $finish_data['data'] = [...$final_look_arr];

            return response()->json($finish_data);
        }
    }
}
