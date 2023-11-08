<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalWorker extends Model
{
    use HasFactory;
    protected $table='signal_worker';
    protected $guarded=[];

    public function signal(){
        return $this->belongsTo(Signal::class,'signal_id');
    }

}
