<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nickname extends Model
{
    use HasFactory;

    protected $table = 'nickname';
    protected $fillable=[
        'name',
    ];

    public function man() {
        return $this->belongsToMany(Man::class, 'man_has_nickname');
    }
}
