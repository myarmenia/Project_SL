<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class CountryAte extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'country_ate';

    protected $fillable = [
        'name'
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }


}
