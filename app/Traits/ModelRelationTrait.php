<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ModelRelationTrait
{
    /**
     * @param  string  $model
     * @param  string  $table
     * @return BelongsToMany
     */
    public function belongsToManyRelation(string $model, string $table): BelongsToMany
    {
        return $this->belongsToMany('App\Models\\'.ucfirst($model), $this->table.'_'.$table);
    }

    /**
     * @param  string  $model
     * @return HasMany
     */
    public function hasManyRelation(string $model): HasMany
    {

        return $this->hasMany(app('App\Models\\'.$model));
    }
}
