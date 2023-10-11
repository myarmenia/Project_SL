<?php

namespace App\Traits;
use App\Traits\ModelRelationTrait as ModelRelationTrait;
trait FilterTrait
{

    public function scopeFilter($builder, $filters = [])
    {

        if (!$filters) {
            return $builder;
        }

        $tableName = $this->getTable();
        $relationFields = $this->relationFields;
        $tableFields = $this->tableFields;
        $hasRelationFields = $this->hasRelationFields;


        foreach ($filters as $field => $data) {
            $name = $data['name'];
            $name = 'resource_id';
            if (isset($data['actions'])) {
                foreach ($data['actions'] as $act) {
                    // if ($name == 'id') {
                    // if ($act['action'] == '=' || $act['action'] == '!=') {
                    //     $builder->where($name, $act['action'], $act['value']);
                    //     continue;
                    // } else {
                    //     $action = str_replace('-', $act['value'], $act['action']);
                    //     $builder->where($name, 'like', $action);
                    //     continue;
                    // }

                    $action = str_replace('-', $act['value'], $act['action']);
                    // dd($action);
                    // if (in_array($name, $tableFields)) {
                    // }
                    if (in_array($name, $relationFields)) {
                        // $field = explode('_id', $name);
                        $builder->whereHas(hasManyRelation('resource'), function ($query) use ($action, $name) {
                            $query->where($name, 'like', $action);
                        });

                        // dd($builder);
                    }
                }
            }

            // dd($builder);

            // if (in_array($field, $this->boolFilterFields) && $value != null) {
            //     $builder->where($field, (bool)$value);
            //     continue;
            // }
            // if (!in_array($field, $defaultFillableFields) || !$value) {
            //     continue;
            // }
            // if (in_array($field, $this->likeFilterFields)) {
            //     $builder->where($tableName . '.' . $field, 'LIKE', "%$value%");
            // } else if (is_array($value)) {
            //     $builder->whereIn($field, $value);
            // } else {
            //     $builder->where($field, $value);
            // }
        }
        return $builder;
    }
}
