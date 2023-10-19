<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarCategory extends Model
{
    use HasFactory;

    protected $table = 'car_category';

    protected $guarded = [];

    public function cars() {
        return $this->hasMany(Car::class);

    }

}