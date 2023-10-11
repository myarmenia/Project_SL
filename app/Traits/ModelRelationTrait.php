<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ModelRelationTrait
{
    /**ManExternalSignHasSign
     * @param  string  $table
     * @return BelongsToMany
     */
    public function belongsToManyRelation(string $table): BelongsToMany
    {
        return $this->belongsToMany('App\Models\\'.ucfirst($table), $this->table.'_has_'.$table);
    }

    /**
     * @param  string  $model
     * @return HasMany
     */
    public function hasManyRelation(string $model): HasMany
    {
        return $this->hasMany('App\Models\\'.$model);
    }
}
