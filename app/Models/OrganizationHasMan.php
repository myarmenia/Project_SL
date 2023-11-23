<?php

namespace App\Models;


use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationHasMan extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'organization_has_man';


    protected $tableFields = ['id', 'title', 'period'];

    protected $manyFilter = ['start_date', 'end_date',];

    public $relation = [];

    public $relationColumn = [
        'id',
        'title',
        'period',
        'start_date',
        'end_date',
    ];

    protected $fillable = [
        'man_id',
        'title',
        'period',
        'organization_id',
        'start_date',
        'end_date',
    ];

    public $modelRelations = ['man', 'organization'];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function man()
    {
        return $this->belongsTo(Man::class, 'man_id');
    }



    public function relation_field()
    {
        return [

            __('content.position') => $this->title ?? null,
            __('content.period') => $this->period ?? null,
            __('content.start_employment') => $this->start_date ?? null,
            __('content.end_employment') => $this->end_date ?? null,
            __('content.organization') => $this->organization->name ?? null,
            __('content.man') => $this->man->first_name ? implode(' ', $this->man->first_name->pluck('first_name')->toArray())  : null

        ];
    }
}
