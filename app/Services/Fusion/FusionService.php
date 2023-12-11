<?php

namespace App\Services\Fusion;
use App\Models\LastName;
use App\Models\FirstName;
use App\Models\MiddleName;
use App\Models\Man\Man;
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

        if ($model->getTable() == 'man') {
            $last_name = count($data['last_name']) > 0 ? LastName::whereIn('id', $data['last_name'])->pluck('last_name')->toArray() : null;
            $first_name = count($data['first_name']) > 0 ? FirstName::whereIn('id', $data['first_name'])->pluck('first_name')->toArray() : null;
            $middle_name = count($data['middle_name']) > 0 ? MiddleName::whereIn('id', $data['middle_name'])->pluck('middle_name')->toArray() : null;


            $last_name = implode(' ', $last_name);
            $first_name = implode(' ', $first_name);
            $middle_name = implode(' ', $middle_name);

            $full_name = ($last_name ? $last_name . ' ' : '') . ($first_name ? $first_name . ' ' : '') . ($middle_name ? $middle_name : '');

            $item->update([
                'full_name' =>  $full_name,
            ]);

            if (array_key_exists('birthday', $data)) {
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
        else{
            return false;
        }
    }


    public static function fusion_more_ids($request)
    {
        $arr_ids = $request->all_fusion_id;
        $first_id = min($arr_ids);

        $model = ModelRelationService::get_model_class($request->tb_name);
        // $first_item = $model->find($first_id);
        $first_item = $model->where('id', $first_id)->first();

        $data = [];
        $item_start_year = '';

        foreach ($arr_ids as $c => $id) {
            $row = $model->where('id', $id)->first();
            $item = $row->relation_field1();
            $data = array_merge_recursive($data, $item);

            if ($model->getTable() == 'man' && $row->start_year != null) {
                $item_start_year = $row->start_year . $c == array_key_last($arr_ids) ? " " : '';
            }
        }
        // dd($data);

        foreach ($data as $key => $value) {

            if (in_array($key, $model->uniqueFields)) {
                $count_array_unique = count(array_unique($value));
                if ($count_array_unique > 1) {
                    return 'data_discrepancy_exists';
                }
            }
        }

        $data = array_filter($data, function ($v, $k) {
            return array_filter($v, function ($i, $j) {
                return ((is_array($i) && count($i) > 0) ||
                    (!is_array($i) && !is_null($i)));
            }, ARRAY_FILTER_USE_BOTH);
        }, ARRAY_FILTER_USE_BOTH);

        // dd($data);

        if ($model->getTable() == 'man') {
            $last_name = $data['last_name'];
            $first_name = $data['first_name'];
            $middle_name = $data['middle_name'];

            array_walk($last_name, function (&$l_name, $n) {
                $l_name = implode(' ', array_keys($l_name));
            });

            array_walk($first_name, function (&$f_name, $f) {
                $f_name = implode(' ', array_keys($f_name));
            });

            array_walk($middle_name, function (&$m_name, $m) {
                $m_name = implode(' ', array_keys($m_name));
            });


            $last_name = implode(' ', $last_name);
            $first_name = implode(' ', $first_name);
            $middle_name = implode(' ', $middle_name);

            $full_name = ($last_name ? $last_name . ' ' : '') . ($first_name ? $first_name . ' ' : '') . $middle_name ? $middle_name : '';

            $first_item->update([
                'full_name' =>  $full_name,
                'start_year' => $item_start_year
            ]);
        }

        foreach ($data as $key => $value) {

            if (in_array($key, $model->uniqueFields)) {

                // $value = end($value);

            } else {
                $item_key_ids = [];

                array_walk_recursive($value, function ($i, $k) use (&$item_key_ids) {

                    return array_push($item_key_ids, $i);
                });

                $first_item->$key()->detach();
                $first_item->$key()->sync($item_key_ids);
            }
        }

        array_shift($arr_ids);

        $delete = $model->whereIn('id', $arr_ids)->delete();

        if ($delete) {
            return true;
        }
        else{
            return false;
        }
    }
}
