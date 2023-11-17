<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeepSignal extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'keep_signal';
    protected $guarded=[];
    protected $relationFields = ['agency', 'subunit_agency', 'passed_subunit_agency'];

    protected $tableFields = ['id'];

    protected $manyFilter = ['start_date', 'end_date', 'pass_date'];

    protected $hasRelationFields = ['worker', 'worker_post'];

    public $modelRelations = ['signal'];


    public $relation = [
        'agency',
        'unit_agency',
        'subunit_agency',
        'worker',
        'worker_post',
        'passed_subunit_agency',
    ];

    public $relationColumn = [
        'id',
        'agency',
        'unit_agency',
        'subunit_agency',
        'worker',
        'worker_post',
        'start_date',
        'end_date',
        'pass_date',
        'passed_subunit_agency',
    ];
    public function signal(){

        return $this->belongsTo(Signal::class,'signal_id');
    }


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
        return $this->belongsTo(Agency::class, 'sub_unit_id');
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



    public function relation_field()
    {
        return [

            __('content.management_signal') => $this->agency ? $this->agency->name : null,
            __('content.department_checking_signal') => $this->unit_agency ? $this->unit_agency->name : null,
            __('content.unit_signal') =>  $this->subunit_agency ? $this->subunit_agency->name : null,
            __('content.unit_signal_transmitted') => $this->passed_subunit_agency ? $this->passed_subunit_agency->name : null,
            __('content.name_operatives') => $this->worker ? implode(', ', $this->worker->pluck('worker')->toArray()) : null,
            __('content.worker_post') => $this->worker_post ? implode(', ', $this->worker_post->pluck('name')->toArray()) : null,
            __('content.start_checking_signal') => $this->start_date ?? null,
            __('content.end_checking_signal') => $this->end_date ?? null,
            __('content.date_transfer_unit') => $this->pass_date ?? null,

        ];
    }

}
