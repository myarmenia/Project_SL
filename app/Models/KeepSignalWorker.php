<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeepSignalWorker extends Model
{
    use HasFactory;

    protected $table = 'keep_signal_worker';
    protected $guarded=[];


    public function keepsignal(){
        return $this->belongsTo(KeepSignal::class,'keep_signal_id');
    }

}
