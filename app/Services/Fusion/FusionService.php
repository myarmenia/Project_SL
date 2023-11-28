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

        if($delete) {
            return true;
        }
    }
}
