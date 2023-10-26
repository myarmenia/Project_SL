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

        // $tableName = $this->getTable();
        $relationFields = $this->relationFields;
        $tableFields = $this->tableFields;
        $hasRelationFields = $this->hasRelationFields;
        $addressFields = $this->addressFields;
        $manyFilter = $this->manyFilter;

        $action = null;
        $like_or_equal = null;

        foreach ($filters as $data) {
            $name = null;
            if (is_array($data)) {
                $name = $data['name'];
            }



            if (isset($data['actions'])) {
                foreach ($data['actions'] as $act) {
                    $words = explode(' ', $act['value']);

                    // ===================================================
                    // man relation from address
                    // ===================================================

                    if (isset($addressFields) && in_array($name, $addressFields)) {

                        $find_text = str_contains($act['action'], '%');

                        if ($find_text) {
                            $action = str_replace('-', $act['value'], $act['action']);
                            $like_or_equal = 'like';
                        } else {
                            $action = $act['value'];
                            $like_or_equal = $act['action'];
                        }

                        $builder->whereHas('bornAddress', function ($query) use ($name, $action, $like_or_equal) {
                            $query->whereHas($name, function ($query1) use ($action, $like_or_equal) {
                                $query1->where('name', $like_or_equal, $action);
                            });
                        });
                    }

                    // ===================================================
                    // man relation by has
                    // ===================================================

                    if (isset($hasRelationFields) && in_array($name, $hasRelationFields)) {
                        $search_name = '';
                        if ($name == 'passport') {
                            $search_name = 'number';
                        } else if ($name == 'first_name' || $name == 'last_name' || $name == 'middle_name') {
                            $search_name = $name;
                        }else if($name == 'more_data') {
                            $search_name = 'text';
                        } else {
                            $search_name = 'name';
                        }

                        foreach ($words as $word) {
                            $find_text = str_contains($act['action'], '%');

                            if ($find_text) {
                                $action = str_replace('-', $word, $act['action']);
                                $like_or_equal = 'like';
                            } else {
                                $action = $act['value'];
                                $like_or_equal = $act['action'];
                            }

                            $builder->whereHas($name, function ($query) use ($action, $search_name, $like_or_equal) {
                                $query->where($search_name, $like_or_equal, $action);
                            });
                        }
                    }

                    // ===================================================
                    // end man relation by has
                    // ===================================================

                    // ===================================================
                    // man filter from manyFilter
                    // ===================================================

                    if (isset($manyFilter) && in_array($name, $manyFilter)) {
                        $query = null;
                        if (isset($data['query'])) {
                            $query = $data['query'];
                        }

                        $like_or_equal = $act['action'];
                        $action = $act['value'];

                        if ($query == 'or') {
                            $builder->orWhere($name, $like_or_equal, $action);
                        } else {
                            $builder->where($name, $like_or_equal, $action);
                        }


                    }

                    // ===================================================
                    // man relation by id
                    // ===================================================

                    if (isset($relationFields) && in_array($name, $relationFields)) {

                        $find_text = str_contains($act['action'], '%');

                        if ($find_text) {
                            $action = str_replace('-', $act['value'], $act['action']);
                            $like_or_equal = 'like';
                        } else {
                            $action = $act['value'];
                            $like_or_equal = $act['action'];
                        }

                        $builder->whereHas($name, function ($query) use ($action, $like_or_equal) {
                            $query->where('name', $like_or_equal, $action);
                        });
                    }

                    // ===================================================
                    // end man relation by id
                    // ===================================================

                    // ===================================================
                    // man filter from man table
                    // ===================================================

                    if (isset($tableFields) && in_array($name, $tableFields)) {

                        $find_text = str_contains($act['action'], '%');

                        if ($find_text) {
                            $action = str_replace('-', $act['value'], $act['action']);
                            $like_or_equal = 'like';
                        } else {
                            $action = $act['value'];
                            $like_or_equal = $act['action'];
                        }
                        $builder->where($name, $like_or_equal, $action);
                    }

                    // ===================================================
                    // end man filter from man table
                    // ===================================================


                }
            }
        }
        return $builder;
    }
}
