<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakenMeasure extends Model
{
    use HasFactory;
    protected $table="taken_measure";
    protected $guarded=[];

    public function signal(){
        return $this->hasMany(Signal::class);
    }
}
