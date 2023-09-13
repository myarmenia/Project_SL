<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'country_id',
        'region_id',
        'locality_id',
        'street_id',
        'city_id',
        'track',
        'home_num',
        'housing_num',
        'apt_num',
        'country_ate_id',
    ];

}
