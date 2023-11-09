<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    use HasFactory;

    protected $table = "signal";
    protected $guarded = [];

    public function signal_qualification()
    {
        return $this->belongsTo(SignalQualification::class, 'signal_qualification_id');
    }
    public function resource()
    {
        return $this->belongsTo(Resource::class, 'source_resource_id');
    }
    public function agency_check_unit()
    {

        return $this->belongsTo(Agency::class, 'check_unit_id');
    }
    public function agency_check()
    {
        return $this->belongsTo(Agency::class, 'check_agency_id');
    }
    public function agency_check_subunit()
    {
        return $this->belongsTo(Agency::class, 'check_subunit_id');
    }
    public function signal_checking_worker()
    {
        return $this->hasMany(SignalCheckingWorker::class);
    }
    public function worker_post()
    {
        return $this->belongsToMany(WorkerPost::class, 'signal_worker_post');
    }
    public function signal_check_date()
    {

        return $this->belongsToMany(CheckDate::class, 'signal_has_check_date');
    }
    public function used_resource(){
        return $this->belongsToMany(Resource::class,'signal_used_resource');
    }
    public function has_taken_measure(){
        return $this->belongsToMany(TakenMeasure::class,'signal_has_taken_measure');
    }
    public function opened_agency(){
        return $this->belongsTo(Agency::class,'opened_agency_id');
    }
    public function opened_unit(){
        return $this->belongsTo(Agency::class,'opened_unit_id');
    }
    public function opened_subunit(){
        return $this->belongsTo(Agency::class,'opened_subunit_id');
    }
    public function signal_worker(){
        return $this->hasMany(SignalWorker::class);
    }
    public function signal_worker_post(){
        return $this->belongsToMany(WorkerPost::class,'signal_worker_post');
    }
    public function man()
    {
        return $this->belongsToMany(Man::class,'signal_has_man');
    }
    public function organization_checked_by_signal()
    {
        return $this->belongsToMany(Organization::class,'organization_checked_by_signal');
    }
    public function  action_passes_signal()
    {
        return $this->belongsToMany(Action::class,'action_passes_signal');
    }
    public function  event()
    {
        return $this->belongsToMany(Event::class,'event_passes_signal');
    }
    public function keep_signal(){
        return $this->hasMany(KeepSignal::class);
    }





}
