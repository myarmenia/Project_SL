<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country';

    protected $fillable = ['name'];


    public function bibliography()
    {
        return $this->belongsToMany(Bibliography::class);
    }

    public function search_man()
    {
        return $this->belongsToMany(Man::class, 'country_search_man');
    }
}
