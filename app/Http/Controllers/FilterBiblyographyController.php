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

        $model = ModelRelationService::get_model_class($table_name);

        if ($id != null) {
            $curent_data = $model->find($id);
            $man = $curent_data->man;
            $man_ids = $man->pluck('id');
            $model = app('App\Models\\' . ucfirst("man") . '\\' . ucfirst('man'));

            $filtered_value = $model->whereIn('id', $man_ids);
        } else {
            $filtered_value = $model->where('id', '>', 0);
        }


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
            }
        }

        $filtered_value = $filtered_value->get();

        foreach ($filtered_value as $f_v) {

            $finish_first_name = '';
            $finish_last_name = '';
            $finish_middle_name = '';

            foreach ($f_v->first_name as $f_name => $first_name) {
                $finish_first_name .= $first_name->first_name . ($f_name !== array_key_last($f_v->first_name->toArray()) ? ' ' : '');
            }

            foreach ($f_v->last_name as $l_name => $last_name) {
                $finish_last_name .= $last_name->last_name . ($l_name !== array_key_last($f_v->last_name->toArray()) ? ' ' : '');
            }

            foreach ($f_v->middle_name as $m_name => $middle_name) {
                $finish_middle_name .= $middle_name->middle_name . ($m_name !== array_key_last($f_v->middle_name->toArray()) ? ' ' : '');;
            }

            $finish_array = [
                'id' => $f_v->id,
                'first_name' => $finish_first_name,
                'last_name' => $finish_last_name,
                'middle_name' => $finish_middle_name,
                'birthday_str' => $f_v->birthday_str,
                'table_name' => $data1['table_name'],
                'table_id' => $data1['table_id'],
            ];

            array_push($returned_array, $finish_array);
        }

        return response()->json($returned_array);
    }
}
