<?php

namespace App\Models;


use App\Models\Man\Man;

use App\Traits\FilterTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationHasMan extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'organization_has_man';


    protected $tableFields = ['id', 'title', 'period'];

    protected $manyFilter = ['start_date', 'end_date',];

    protected $fillable = [
        'man_id',
        'title',
        'period',
        'organization_id',
        'start_date',
        'end_date',
    ];

    public function organization() {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function man() {
        return $this->belongsTo(Man::class, 'man_id');
    }


    public function relation_field()
    {
        return [
            'position' => $this->title ?? null,
            'period' => $this->period ?? null,
            'start_employment' => $this->start_date ?? null,
            'end_employment' => $this->end_date ?? null,
            'organization' => $this->organization->name ?? null,
            'man' => $this->man->first_name ? implode(' ', $this->man->first_name->pluck('first_name')->toArray())  : null

        ];
    }
}
