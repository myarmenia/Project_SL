<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NickName extends Model
{
    use HasFactory;

    protected $table = 'nickname';

    protected $fillable = [
        'name',
    ];
}
