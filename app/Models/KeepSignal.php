<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeepSignal extends Model
{
    use HasFactory;

    protected $table = 'keep_signal';

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function unit_agency()
    {
        return $this->belongsTo(Agency::class, 'unit_id');
    }

    public function subunit_agency()
    {
        return $this->belongsTo(Agency::class, 'subunit_id');
    }

    public function worker()
    {
        return $this->hasMany(KeepSignalWorker::class);
    }

    public function worker_post()
    {
        return $this->belongsToMany(WorkerPost::class, 'keep_signal_worker_post');
    }

    public function passed_subunit_agency()
    {
        return $this->belongsTo(Agency::class, 'pased_sub_unit');
    }
}
