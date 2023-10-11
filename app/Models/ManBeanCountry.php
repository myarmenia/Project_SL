<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ManBeanCountry extends Model
{
    use HasFactory;

    protected $table = 'man_bean_country';

    protected $fillable = [
        'man_id',
        'locality_id',
        'region_id'
    ];

    public function locality(): BelongsTo
    {
        return $this->belongsTo(Locality::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
