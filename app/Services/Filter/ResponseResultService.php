<?php

namespace App\Services\Filter;

use App\Models\Address;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponseResultService
{


    public static function get_result($result, $model, $type)
    {

        $tableName = $model->getTable();

        if ($type == 'optimization') {
            $current_data = $result;
        } else {
            $current_data = $result['data'];
        }

        $final_look_arr = [];
        $finish_data = [];

        foreach ($current_data as $data) {
            if (isset($data['born_address']) && $tableName != 'address') {
                $address_relations = Address::with('country_ate', 'region', 'locality')->first();
                $data['countryAte'] = $address_relations->country_ate->name ?? null;
                $data['region'] = $address_relations->region->name ?? null;
                $data['locality'] = $address_relations->locality->name ?? null;
            }
            $new_arr = array_intersect_key($data, array_flip($model->relationColumn));

            $finsih_array = [];

            array_walk($new_arr, function ($value, $key) use (&$finsih_array) {

                $search_name = '';

                if ($key == 'material_content') {
                    $search_name = 'content';
                } else if ($key == 'worker' || $key == 'signal_checking_worker' || $key == 'signal_worker') {
                    $search_name = 'worker';
                } else if ($key == 'first_name' || $key == 'last_name' || $key == 'middle_name') {
                    $search_name = $key;
                } else if ($key == 'passport') {
                    $search_name = 'number';
                } else if ($key == 'more_data') {
                    $search_name = 'text';
                } else if ($key == 'user') {
                    $search_name = 'username';
                } else if ($key == 'files_real_name') {
                    $search_name = 'real_name';
                } else if ($key == 'files_comment') {
                    $search_name = 'file_comment';
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
                        $value = $value != null ? date('d-m-Y', strtotime($value)) : null;
                    }

                    if ($key == 'files_count1') {
                        $returned_value = count($value);
                    } else {
                        $returned_value = is_array($value) ? (!empty($value) ? $value : null) : $value;
                    }
                }
                $finsih_array[$key] = $returned_value;
            });
            $sortedArray = array_merge(array_flip($model->relationColumn), $finsih_array);

            array_push($final_look_arr, $sortedArray);
        }

        $finish_data['data'] = [...$final_look_arr];

        return $finish_data;
    }
}
