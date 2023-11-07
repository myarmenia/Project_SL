<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckDate extends Model
{
    use HasFactory;
    protected $table="check_date";
    protected $guarded=[];

    public function signal(){
        return $this->belongsToMany(Signal::class,'signal_has_check_date');
    }
}
