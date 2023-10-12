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

        $action = null;
        $like_or_equal = null;

        foreach ($filters as $data) {
            $name = null;
            if (is_array($data)) {
                $name = $data['name'];
            }



            if (isset($data['actions'])) {
                foreach ($data['actions'] as $act) {

                    $find_text = str_contains($act['action'], '%');

                    if ($find_text) {
                        $action = str_replace('-', $act['value'], $act['action']);
                        $like_or_equal = 'like';
                    } else {
                        $action = $act['value'];
                        $like_or_equal = $act['action'];
                    }

                    // if ($name == 'id') {
                    // if ($act['action'] == '=' || $act['action'] == '!=') {
                    //     $builder->where($name, $act['action'], $act['value']);
                    //     continue;
                    // } else {
                    //     $action = str_replace('-', $act['value'], $act['action']);
                    //     $builder->where($name, 'like', $action);
                    //     continue;
                    // }

                    // ===================================================
                    // man relation by has
                    // ===================================================

                    if (in_array($name, $hasRelationFields)) {
                        $builder->whereHas($name, function ($query) use ($action, $name, $like_or_equal) {
                            $query->where($name, $like_or_equal, $action);
                        });
                    }

                    // ===================================================
                    // end man relation by has
                    // ===================================================

                    // ===================================================
                    // man relation by id
                    // ===================================================
                    if (in_array($name, $relationFields)) {
                        $field = explode('_id', $name);
                        if (count($field) > 1) {
                            $builder->whereHas($field[0], function ($query) use ($action, $like_or_equal) {
                                $query->where('name', $like_or_equal, $action);
                            });
                        }
                    }
                    // ===================================================
                    // end man relation by id
                    // ===================================================
                }
            }
        }
        return $builder;
    }
}
