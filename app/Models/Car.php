<?php

namespace App\Models;

use App\Models\Man\Man;
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

    public function man() {
        return $this->belongsToMany(Man::class, 'man_has_car');
    }

    public function relation_field(){
        return [
            "car_cat" => $this->car_category->name ?? null,
            "mark" => $this->car_mark->name ?? null,
            "color" =>  $this->color->name ?? null,
            "car_number" => $this->number ?? null,
            "count" => $this->count ?? null,
            "additional_data" => $this->note ?? null

        ];
    }

}
