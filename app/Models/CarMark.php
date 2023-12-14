<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarMark extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'car_mark';

    protected $guarded = [];

    public function cars() {
        return $this->hasMany(Car::class);

    }

}
