<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManBeanCountry extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'man_bean_country';

    protected $relationFields = ['country_ate', 'goal', 'locality', 'region','man'];

    protected $tableFields = ['id'];

    protected $manyFilter = ['entry_date', 'exit_date', 'created_at'];

    public $relation = [
        'goal',
        'country_ate',
        'region',
        'locality',
    ];

    public $relationColumn = [
        'id',
        'goal',
        'country_ate',
        'entry_date',
        'exit_date',
        'region',
        'locality',
        'created_at'
    ];

    // protected $fillable = [
    //     'man_id',
    //     'locality_id',
    //     'region_id'
    // ];

    protected $guarded = [];

    public $modelRelations = ['man'];


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

    public function man()
    {
        return $this->belongsTo(Man::class, 'man_id');
    }

    public function relation_field()
    {
        return [
            __('content.ountry_ate') => $this->country_ate->name ?? null,
            __('content.purpose_visit') => $this->goal->name ?? null,
            __('content.region') => $this->region->name ?? null,
            __('content.locality') => $this->locality->name ?? null,
            __('content.entry_date') => $this->entry_date ?? null,
            __('content.exit_date') => $this->exit_date ?? null,

        ];
    }
}
