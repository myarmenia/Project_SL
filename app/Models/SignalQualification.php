<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SignalQualification extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'signal_qualification';

    protected $fillable = ['name'];

    public function signal(){
        return $this->hasMany(Signal::class);
    }

}
