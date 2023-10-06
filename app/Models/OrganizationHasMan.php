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
}
