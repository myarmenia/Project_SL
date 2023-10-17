<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $table = 'party';

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_party');
    }

}
