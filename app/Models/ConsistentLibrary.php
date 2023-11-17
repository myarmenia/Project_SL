<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsistentLibrary extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded=['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consistentSearch()
    {
        return $this->belongsTo( ConsistentSearch::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function library()
    {
        return $this->hasOne(Library::class, 'id', 'library_id');
    }
}
