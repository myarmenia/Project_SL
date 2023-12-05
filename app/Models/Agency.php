<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Agency extends Model
{
    use HasFactory;

    protected $table = 'agency';

    protected $fillable = ['name'];

    public function bibliography(){
        return $this->hasMany(Bibliography::class);
    }
    public function signal(){
        return $this->hasMany(Signal::class);
    }
    public function controll(){
        return $this->hasMany(Controll::class);
    }

}
