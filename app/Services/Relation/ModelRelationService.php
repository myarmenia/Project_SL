<?php

namespace App\Services\Relation;

class ModelRelationService
{
    public static function model_relation(string $table_name, $model_id)
    {


        $model = self::get_model_class($table_name);

        $row = $model->with($model->modelRelations)->find($model_id);

        $relations = $row->getRelations($model_id);

        $data = [];

        foreach ($relations as $key => $relation) {

            $relation = $relation != null ? $relation->toArray() : null;
            $relation_fields = [];
            $relation_type = class_basename($model->{$key}());

            $get_class = get_class($model->{$key}()->getRelated());
            $relation_class = app($get_class);

            $tb_name = $model->{$key}()->getRelated()->getTable();

            $relation_fields['relation_name'] = $tb_name;

            if($tb_name == 'control'){
                $relation_fields['relation_name'] = 'controll';
            }


            $relation_fields['relation_name_translation'] = __("content.$tb_name");

            if ((!is_array($relation) && $relation != null) || (is_array($relation) && count($relation) > 0)) {

                if ($relation_type == 'BelongsToMany' || $relation_type == 'HasMany') {

                    foreach ($relation as $k => $value) {


                        $value = isset($value['first_object_id']) && $value['first_object_id'] == $model_id ? array_replace($value, ['id' => $value['second_object_id']]) : $value;
                        $value = isset($value['second_object_id']) && $value['second_object_id'] == $model_id ? array_replace($value, ['id' => $value['first_object_id']]) : $value;

                        $id = key($value);

                        $relation_fields['relation_id'] = $value['id'] ?? null;


                        // $rel_model = $relation_class->where($id, $value[$id])->first();

                        // $relation_fields['fields'] = method_exists($rel_model, 'relation_field') ? $rel_model->relation_field() : null;

                        array_push($data, $relation_fields);
                    }
                } else {

                    $relation_fields['relation_id'] = $relation['id'] ?? null;

                    // $rel_model = $relation_class->find($relation['id']);

                    // $relation_fields['fields'] = method_exists($rel_model, 'relation_field') ? $rel_model->relation_field() : null;


                    array_push($data, $relation_fields);
                }
            }
        }

        $data = self::uniq_array($data);

        return $data;
    }




    public static function model_single_relation(string $table_name, $model_id){
        $model = self::get_model_class($table_name);
        $single_model = $model->find($model_id);
        $data = [];
        $relation_fields = [];

        $relation_fields['relation_name'] = $table_name;
        $relation_fields['relation_id'] = $model_id;

        if($table_name == 'control'){
            $relation_fields['relation_name'] = 'controll';
        }

        $relation_fields['relation_name_translation'] = __("content.$table_name");
        $relation_fields['fields'] = method_exists($single_model, 'relation_field') ? $single_model->relation_field() : null;

        array_push($data, $relation_fields);
        return $data;


    }

    public static function uniq_array($data)
    {

        $tmp = [];
        foreach ($data as $key => $value) {
            if (isset($tmp[$value['relation_name']]) && array_key_exists($value['relation_id'], $tmp[$value['relation_name']])) {
                unset($data[$key]);
            } else {
                $tmp[$value['relation_name']][$value["relation_id"]] = true;
            }
        }


        return $data;
    }



    public static function get_model_class($table_name)
    {
        $find_text = str_contains($table_name, '_');

        if ($find_text && $table_name != 'work_activity') {
            $model_name = str_replace('_', '', ucwords($table_name, '_'));
        } else {
            $model_name = $table_name;
        }

        if ($table_name == 'man' || $table_name == 'bibliography') {
            $model_name =  ucfirst($model_name) . '\\' . ucfirst($model_name);

        }
        else if ($table_name == 'users') {
            $model_name = ucfirst('User');
        }

        else if ($table_name == 'work_activity') {

            $model_name = ucfirst('OrganizationHasMan');
        } else {
            $model_name =  ucfirst($model_name);
        }

        return app('App\Models\\' . $model_name);
    }


}
