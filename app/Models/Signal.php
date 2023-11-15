<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
    public function criminal_case()
    {
        return $this->belongsToMany(CriminalCase::class,'criminal_case_has_signal');
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

    public function bibliography()
    {
        return $this->belongsTo(Bibliography::class, 'bibliography_id');
    }

    public function signal_result()
    {
        return $this->belongsTo(SignalResult::class, 'signal_result_id');
    }


    public function checking_worker_post()
    {
        return $this->belongsToMany(WorkerPost::class, 'signal_checking_worker_post');
    }

    public function passes_by_signal()
    {
        return $this->belongsToMany(Organization::class, 'organization_passes_by_signal');
    }


    public function relation_field()
    {
        return [
            __('content.reg_number_signal') => $this->reg_num ?? null,
            __('content.contents_information_signal') => $this->content ?? null,
            __('content.line_which_verified') => $this->check_line ?? null,
            __('content.check_status_charter') => $this->check_status ?? null,
            __('content.qualifications_signaling') => $this->signal_qualification ? $this->signal_qualification->name : null,
            __('content.source_category') => $this->resource ? $this->resource->name : null,
            __('content.checks_signal') => $this->agency_check ? $this->agency_check->name : null,
            __('content.department_checking') => $this->agency_check_unit ? $this->agency_check_unit->name : null,
            __('content.unit_testing') => $this->agency_check_subunit ? $this->agency_check_subunit->name : null,
            __('content.name_checking_signal') => $this->signal_checking_worker ? implode(', ', $this->signal_checking_worker->pluck('worker')->toArray()) : null,
            __('content.worker_post') => $this->checking_worker_post ? implode(', ', $this->checking_worker_post->pluck('name')->toArray()) : null,
            __('content.date_registration_division') => $this->subunit_date ?? null,
            __('content.check_date') => $this->check_date ?? null,
            __('content.date_actual') => $this->end_date ?? null,
            __('content.useful_capabilities') => $this->resource ?  implode(', ', $this->resource->pluck('name')->toArray()) : null,
            __('content.signal_results') => $this->signal_result->name ?? null,
            __('content.measures_taken') => $this->has_taken_measure ? implode(', ', $this->has_taken_measure->pluck('name')->toArray()) : null,
            __('content.according_result_dow') => $this->opened_dou ?? null,
            __('content.brought_signal') => $this->opened_agency ? $this->opened_agency->name : null,
            __('content.department_brought') => $this->opened_unit ? $this->opened_unit->name : null,
            __('content.name_operatives') => $this->signal_worker ? implode(', ', $this->signal_worker->pluck('worker')->toArray()) : null,
            __('content.report_3') => $this->signal_worker_post ? implode(', ', $this->signal_worker_post->pluck('name')->toArray()) : null,
            __('content.amount_overdue') => $this->more_data ?? null,
    ];
    }


    public function count_number()
    {
        $endDate=$this->end_date;
        $startDate=$this->check_date;
        $startCarbon = Carbon::parse($startDate);
        $endCarbon = Carbon::parse($endDate);
        $dayDifference = $startCarbon->diffInDays($endCarbon);

      return  $dayDifference;

    }
}
