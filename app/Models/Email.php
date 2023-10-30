<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{

    use HasFactory, FilterTrait;

    protected $table = 'email';

    protected $tableFields = ['id', 'address'];

    protected $fillable = [
        'address',
    ];
}
