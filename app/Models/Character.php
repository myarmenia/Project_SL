<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{

    protected $table = 'character';

    use HasFactory;

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_phone');
    }
}
