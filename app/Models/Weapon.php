<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'weapon';

    protected $tableFields = ['id', 'category', 'view', 'type', 'model', 'reg_num', 'count'];

    protected $guarded = [];

}
