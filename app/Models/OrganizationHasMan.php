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
            'position' => 'Պաշտոն',
            'period' => 'Ժամանակահատվածին վերաբերող տվյալները',
            'start_employment' => 'Աշխատանքային գործունեության սկիզբ',
            'end_employment' => 'Աշխատանքային գործունեության ավարտ',
            'organization' => '',
            'man' => ''

        ];
    }
}
