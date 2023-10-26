<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationHasMan extends Model
{
    use HasFactory;

    protected $table = 'organization_has_man';

    protected $fillable = [
        'title',
        'period',
        'organization_id',
        'start_date',
        'end_date',
    ];


    public function relation_field()
    {
        return [
            'country' => $this->country_ate->name ?? null,
            'position' => $this->title ?? null,
            'period' => $this->period ?? null,
            'start_employment' => $this->start_date ?? null,
            'end_employment' => $this->end_date ?? null,
            'organization' => '',
            'man' => ''

        ];
    }
}
