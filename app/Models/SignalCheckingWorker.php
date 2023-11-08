<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalCheckingWorker extends Model
{
    use HasFactory;
    protected $table="signal_checking_worker";
    protected $guarded=[];


    public function signal(){
        return $this->belongsToMany(Signal::class,'signal_id');
    }

}
