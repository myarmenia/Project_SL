<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ControlResult extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='control_result';
    protected $guarded=[];

    public function controll(){
        return $this->hasMany(Controll::class);
    }

}
