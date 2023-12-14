<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TakenMeasure extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="taken_measure";
    protected $guarded=[];

    public function signal(){
        return $this->hasMany(Signal::class);
    }
}
