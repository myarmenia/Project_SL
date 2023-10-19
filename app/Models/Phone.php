<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phone';

    protected $fillable = [
        'number',
        'more_data',
    ];

    public function character() {
        return $this->belongsToMany(Character::class, 'man_has_phone');
    }
}
