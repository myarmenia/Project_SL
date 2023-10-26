<?php

namespace App\Services\Relation;

use Illuminate\Http\Request;

class ModelRelationService
{
    public static function model_relation(string $table_name, $model_id)
    {

        $model = self::get_model_class($table_name);

        $row = $model->with($model->modelRelations)->find($model_id);

        $relations = $row->getRelations();
        $data = [];

        foreach ($relations as $key => $relation) {

            $relation = $relation != null ? $relation->toArray() : null;
            $relation_fields = [];
            $relation_type = class_basename($model->{$key}());
            dump($relation_type);

            $relation_fields['relation_name'] = $key;

            if ((!is_array($relation) && $relation != null) || (is_array($relation) && count($relation) > 0)) {

                if ($relation_type == 'BelongsToMany' || $relation_type == 'HasMany') {

                    foreach ($relation as $k => $value) {

                        $relation_fields['relation_id'] = $value['id'] ?? null;
                        $rel_model = self::get_model_class($key)->find($value['id']);
                        $relation_fields['fields'] = $rel_model->relation_field() ?? null;

                        array_push($data, $relation_fields);
                    }
                }
                else {
                    $relation_fields['relation_id'] = $relation['id'] ?? null;
                    $rel_model = self::get_model_class($key)->find($relation['id']);
                    $relation_fields['fields'] = $rel_model->relation_field() ?? null;

                    array_push($data, $relation_fields);
                }


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
        } else if ($table_name == 'work_activity') {
            $model_name = ucfirst('OrganizationHasMan');
        } else {
            $model_name =  ucfirst($model_name);
        }

        $model_class = app('App\Models\\' . $model_name);

        return $model_class;
    }
}
