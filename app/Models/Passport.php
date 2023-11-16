<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;

    protected $table = 'passport';

    protected $fillable = [
        'number',
    ];

    public function man() {
        return $this->belongsToMany(Man::class, 'man_has_passport');
    }
}
