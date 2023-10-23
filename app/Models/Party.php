<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $table = 'party';

    protected $fillable = [
      'name'
    ];

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_party');
    }

}
