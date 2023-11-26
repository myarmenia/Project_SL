<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsistentSearch extends Model
{
    use HasFactory, SoftDeletes;

    const NOTIFICATION_TYPES = [
        'INCOMING' => 'incoming',
        'UPLOADING' => 'uploading',
        'SEARCHING' => 'searching',
    ];


    const SEARCH_TYPES = [
        'MAN' => 'man',
        'ORGANIZATION' => 'organization'
    ];


    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consistentLibraries()
    {
        return $this->hasMany(ConsistentLibrary::class, 'consistent_search_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consistentFollowers()
    {
        return $this->hasMany(ConsistentFollower::class, 'consistent_search_id', 'id');
    }
}
