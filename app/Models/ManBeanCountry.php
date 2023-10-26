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

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function country_ate()
    {
        return $this->belongsTo(CountryAte::class);
    }

    public function locality(): BelongsTo
    {
        return $this->belongsTo(Locality::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function relation_field()
    {
        return [
            'purpose_visit' => $this->goal->name ?? null,
            'country_ate' => $this->country_ate->name ?? null,
            'region' => $this->region->name ?? null,
            'locality' => $this->locality->name ?? null,
            'entry_date' => $this->entry_date ?? null,
            'exit_date' => $this->exit_date ?? null,

        ];
    }
}
