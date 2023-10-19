<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'car';

    protected $guarded = [];

    public function car_category() {
        return $this->belongsTo(CarCategory::class, 'category_id');
    }

    public function car_mark() {
        return $this->belongsTo(CarMark::class, 'mark_id');
    }

    public function color() {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
