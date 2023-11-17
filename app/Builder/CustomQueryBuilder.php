<?php

namespace App\Builder;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class CustomQueryBuilder extends Builder
{
    protected string $table;
    protected object $result;

    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * @param  array  $attributes
     * @return CustomQueryBuilder
     */
    public function insertGet(array $attributes): CustomQueryBuilder
    {
        $id = DB::table($this->table)->insertGetId($attributes);

        $this->result = DB::table($this->table)->where('id', $id)->first();

        return $this;
    }

    /**
     * @param  string  $relation
     * @param  null  $teableName
     * @return object
     */
    public function with(string $relation, $teableName = null): object
    {
        $forignColumn = $relation.'_id';

        $teableName = $teableName ?? $relation;

        $relationData = DB::table($teableName)->where('id', $this->result->$forignColumn)->first();

        $this->result->$relation = $relationData;

        return $this->result;
    }

    /**
     * @return object
     */
    public function result(): object
    {
        return $this->result;
    }
}
