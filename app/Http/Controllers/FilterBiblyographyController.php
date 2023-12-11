<?php

namespace App\Http\Controllers;

use App\Services\Relation\ModelRelationService;
use Illuminate\Http\Request;

class FilterBiblyographyController extends Controller
{
    public function filter1(Request $request)
    {

        $data = $request->all();
        $id = $data[0]['table_id'];

        $table_name = $data[0]['table_name'];
        $find_text = str_contains($table_name, '_');

        // if ($find_text) {
        //     $model_name = str_replace('_', '', ucwords($table_name, '_'));
        // } else {
        //     $model_name = ucfirst($table_name);
        // }

        // $model = app('App\Models\\' . $model_name);
        $model = ModelRelationService::get_model_class($table_name);
        $curent_data = $model->find($id);
        $man = $curent_data->man;
        $man_ids = $man->pluck('id');
        $model = app('App\Models\\' . ucfirst("man") . '\\' . ucfirst('man'));
        $filtered_value = $model->whereIn('id', $man_ids);

        $action = null;
        $value = null;

        $returned_array = [];

        foreach ($data as $data1) {

            if (isset($data1['actions'])) {
                foreach ($data1['actions'] as $data_action) {
                    $name = $data1['name'];
                    $action = $data_action['action'];
                    $value = $data_action['value'];

                    $find_text = str_contains($action, '%');

                    if ($find_text) {
                        $action = str_replace('-', $value, $action);
                        $like_or_equal = 'like';
                    } else {
                        $like_or_equal = $action;
                        $action = $value;
                    }
                    if ($name != 'id' && $name != 'birthday_str') {
                        $filtered_value = $model->whereIn('id', $man_ids)->whereHas($name, function ($query) use ($name, $like_or_equal, $action) {
                            $query->where($name, $like_or_equal, $action);
                        });
                    } else {
                        $filtered_value = $filtered_value->where($name, $like_or_equal, $action);
                    }
                }
                $filtered_value = $filtered_value->get();
            }
        }

        foreach ($filtered_value as $f_v) {

            dd($f_v->first_name);

            $finish_array = [
                'id' => $f_v->id,
                //     'first_name' => $filtered_value;
            ];

            array_push($returned_array, $finish_array);
        }
        // $returned_array = [
        //     'id' => $filtered_value->id,
        //     'first_name' => $filtered_value;
        // ];
    }
}
