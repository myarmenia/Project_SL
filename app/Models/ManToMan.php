<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManToMan extends Model
{
    use HasFactory;


    protected $table = 'man_to_man';

    protected $guarded = [];

    
}
