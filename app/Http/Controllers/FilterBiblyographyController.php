<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterBiblyographyController extends Controller
{
    public function filter1(Request $request)
    {
        $data = $request->all();
        $id = $data['table_id'];

        $table_name = $data[0]['table_name'];
        $find_text = str_contains($table_name, '_');

        if ($find_text && $table_name != 'work_activity') {
            $model_name = str_replace('_', '', ucwords($table_name, '_'));
        } else {
            $model_name = ucfirst($table_name);
        }

        $model = app('App\Models\\' . $model_name);
        $curent_data = $model->find($id);
        $man = $curent_data->man;

        $action = null;
        $value = null;

        foreach ($data as $data1) {
            if (isset($data1['actions'])) {
                foreach ($data1['actions'] as $data_action) {
                    $action = $data_action['action'];
                    $value = $data_action['value'];
                    $name = $data1['name'];

                    if ($name == 'id' || $name == 'birthday_str') {
                        $filtered_value = $man->where($name, $action, $value);
                    } else {
                        $filtered_value = $model->whereHas($name, function ($query) use ($name, $value, $action) {
                            $query->where($name, $action, $value);
                        });
                    }

                    dd($filtered_value);
                }
            }
        }
    }
}
