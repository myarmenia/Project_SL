<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ComponentService
{
    /**
     * @param  object  $man
     * @param  array  $attributes
     * @param  string  $relation
     * @return void
     */
    public static function storeHasMany(object $man, array $attributes, string $relation): void
    {
        $man->hasManyRelation($relation)->create($attributes);
    }

    /**
     * @param  object  $man
     * @param  array  $attributes
     * @param  string  $table
     * @return void
     */
    public static function storeBelongsToMany(object $man, array $attributes, string $table): void
    {
        $man->belongsToManyRelation($table)->create($attributes);
    }

    public static function storeInsertRelations(
        object $man,
        string $mainTable,
        array $mainAttributes,
        array $relationAttributes
    ): void {
        $tableId = DB::table($mainTable)->insertGetId($mainAttributes);

        DB::table('man_has_'.$mainTable)->insert(
            [
                'man_id' => $man->id,
                $mainTable.'_id' => $tableId,
            ] + $relationAttributes
        );
    }
}
