<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMark extends Model
{
    use HasFactory;

    protected $table = 'car_mark';

    protected $guarded = [];

    public function cars() {
        return $this->hasMany(Car::class);

    }

}
