<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManHasAddress extends Model
{
    use HasFactory;

    protected $table = 'man_has_address';

    protected $fillable = [
        'man_id',
        'address_id',
        'start_date',
        'end_date',
    ];

}
