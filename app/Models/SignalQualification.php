<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalQualification extends Model
{
    use HasFactory;
    protected $table = 'signal_qualification';

    protected $fillable = ['name'];

    public function signal(){
        return $this->hasMany(Signal::class);
    }

}
