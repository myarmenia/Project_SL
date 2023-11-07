<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerPost extends Model
{
    use HasFactory;

    protected $table = 'worker_post';
    protected $guarded=[];

    public function keep_signal() {
        return $this->belongsToMany(KeepSignal::class, 'keep_signal_worker_post');
    }

    public function criminal_case()
    {
        return $this->belongsToMany(CriminalCase::class, 'criminal_case_worker_post');
    }
    public function signal()
    {
        return $this->belongsToMany(Signal::class,'signal_worker_post');
    }
}
