<?php

namespace App\Services\Fusion;

use App\Services\Relation\ModelRelationService;

class FusionService
{

    public static function items($request)
    {

        $first_id = min($request->first_id,  $request->second_id);
        $second_id = max($request->first_id,  $request->second_id);

        $table_name = $request->name;
        $model = ModelRelationService::get_model_class($table_name);

        $first_item = $model->where('id', $request->first_id)->first()->relation_field1();
        $second_item = $model->where('id', $request->second_id)->first()->relation_field1();
        $data = array_merge_recursive($first_item, $second_item);

        $data = array_filter($data, function ($v, $k) {
            return (((is_array($v[0]) && count($v[0]) > 0) || (is_array($v[1]) && count($v[1]) > 0)) ||
                ((!is_array($v[0]) && !is_null($v[0])) || (!is_array($v[1]) && !is_null($v[1]))));
        }, ARRAY_FILTER_USE_BOTH);

        // dd($data);

        $uniqueFields = $model->uniqueFields;

        return [
            'data' => $data,
            'uniqueFields' => $uniqueFields,
            'table_name' => $table_name,
            'first_id' => $first_id,
            'second_id' => $second_id
        ];
    }


    public static function fusion($request, $table_name, $first_id, $second_id)
    {

        $model = ModelRelationService::get_model_class($table_name);
        $item =  $model->find($first_id);
        $second_item =  $model->find($second_id);

        $data = $request->all();

        if ($model->getTable() == 'man' && array_key_exists('birthday', $data)) {
            $first_birthday = $item->birthday;
            $second_birthday = $second_item->birthday;
            $date = $first_birthday != $data['birthday'] ? $first_birthday : ($second_birthday != $data['birthday'] ? $second_birthday : null);
            $item_start_year = $item->start_year . " $date";
            $birth_day =  $data['birthday'] != null ? date('d', strtotime($data['birthday'])) : null;
            $birth_month =  $data['birthday'] != null ? date('m', strtotime($data['birthday'])) : null;
            $birth_year =  $data['birthday'] != null ? date('Y', strtotime($data['birthday'])) : null;

            $item->update([
                'start_year' => $item_start_year,
                'birth_day' =>  $birth_day,
                'birth_month' =>  $birth_month,
                'birth_year' =>  $birth_year
            ]);
        }

        foreach ($data as $key => $value) {

            if (in_array($key, $model->uniqueFields)) {
                $item->update([$key => $value]);
            } else {

                $pivot_array = $item->$key()->pluck('id')->toArray();
                $array_intersect = array_intersect($value, $pivot_array);

                if (count($array_intersect) > 0) {
                    $item->$key()->detach();
                }

                $item->$key()->sync($value);
            }
        }



        $delete = $second_item->delete();

        if ($delete) {
            return true;
        }
    }


    public static function fusion_more_ids($request)
    {
        $arr_ids = $request->all_fusion_id;
        $first_id = min($arr_ids);

        $model = ModelRelationService::get_model_class($request->tb_name);
        // $item =  $model->find($first_id);
$data = [];
        // $first_item = $model->where('id', $first_id)->first()->relation_field1();
        // $arr = array_merge_recursive($first_item, $arr);
        foreach ($arr_ids as $id) {
            $item = $model->where('id', $id)->first()->relation_field1();

            $data = array_merge_recursive($data,$item);
        }

        $data = array_filter($data, function ($v, $k) {
            return array_filter($v, function ($i, $j) {
                return ((is_array($i) && count($i) > 0) ||
                    (!is_array($i) && !is_null($i)));
            }, ARRAY_FILTER_USE_BOTH);
        }, ARRAY_FILTER_USE_BOTH);

        // dd($data);


        // if ($model->getTable() == 'man' && array_key_exists('birthday', $data)) {

        //     $item_start_year = implode(' ', $data['birthday']);
        //     // $birth_day =  $data['birthday'] != null ? date('d', strtotime($data['birthday'])) : null;
        //     // $birth_month =  $data['birthday'] != null ? date('m', strtotime($data['birthday'])) : null;
        //     // $birth_year =  $data['birthday'] != null ? date('Y', strtotime($data['birthday'])) : null;

        //     $item->update([
        //         'start_year' => $item_start_year,
        //         // 'birth_day' =>  $birth_day,
        //         // 'birth_month' =>  $birth_month,
        //         // 'birth_year' =>  $birth_year
        //     ]);
        // }

        foreach ($data as $key => $value) {

            // if (in_array($key, $model->uniqueFields)) {
            //     $value = end($value);
            //     $item->update([$key => $value]);
            // }
            // else {
            $item_key_ids = [];
            foreach ($value as $val) {
                $item_key_ids=array_merge(...array_values($val));
            }
dd($item_key_ids);
                // $pivot_array = $item->$key()->pluck('id')->toArray();
                $pivot_array = [1,9];

                $array_intersect = array_intersect($value, $pivot_array);
dd($pivot_array);
                if (count($array_intersect) > 0) {
                    $item->$key()->detach();
                }

                $item->$key()->sync($value);
            // }
        }



        $delete = $second_item->delete();

        if ($delete) {
            return true;
        }
    }
}
