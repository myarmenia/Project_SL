<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $table = 'resource';

    protected $guarded = [];

    public function man() {
        return $this->hasMany(Man::class);
    }
    public function signal() {
        return $this->hasMany(Signal::class);
    }
    public function signal_resource(){
        return $this->belongsToMany(Signal::class,'signal_used_resource');
    }



}
