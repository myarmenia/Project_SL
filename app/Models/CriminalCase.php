<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CriminalCase extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'criminal_case';
    protected $guarded = [];

    protected $relationFields = ['opened_agency', 'opened_unit_agency', 'subunit_agency'];

    protected $tableFields = ['id', 'number', 'artical', 'character', 'opened_dou'];

    protected $manyFilter = ['opened_date'];

    protected $hasRelationFields = ['worker', 'worker_post'];

    protected $count = ['man_count'];

    public $modelRelations = ['man',  'organization', 'event', 'signal', 'action', 'criminal_case_extracted', 'criminal_case_splited', 'bibliography'];


    public $relation = [
        'opened_agency',
        'opened_unit_agency',
        'subunit_agency',
        'worker',
        'worker_post',
        'man_count1'
    ];

    public $relationColumn = [
        'id',
        'number',
        'opened_date',
        'artical',
        'opened_agency',
        'opened_unit_agency',
        'subunit_agency',
        'worker',
        'worker_post',
        'character',
        'opened_dou',
        'man_count1'
    ];

    public function opened_agency()
    {
        return $this->belongsTo(Agency::class, 'opened_agency_id');
    }

    public function opened_unit_agency()
    {
        return $this->belongsTo(Agency::class, 'opened_unit_id');
    }

    public function subunit_agency()
    {
        return $this->belongsTo(Agency::class, 'subunit_id');
    }

    public function worker() {
        return $this->hasMany(CriminalCaseWorker::class, 'criminal_case_id');
    }

    public function worker_post()
    {
        return $this->belongsToMany(WorkerPost::class, 'criminal_case_worker_post');
    }

    public function man_count1() {
        return $this->belongsToMany(Man::class, 'criminal_case_has_man');
    }

    public function man()
    {
        return $this->belongsToMany(Man::class, 'criminal_case_has_man');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'criminal_case_has_organization');
    }

    public function action()
    {
        return $this->belongsToMany(Action::class, 'action_has_criminal_case');
    }

    public function event()
    {
        return $this->belongsToMany(Event::class, 'event_has_criminal_case');
    }

    public function signal()
    {
        return $this->belongsToMany(Signal::class, 'criminal_case_has_signal');
    }

    public function criminal_case_extracted()
    {
        return $this->belongsToMany(CriminalCase::class, 'criminal_case_extracted_criminal_case', 'criminal_case_id', 'criminal_case_id1');
    }

    public function criminal_case_splited()
    {
        return $this->belongsToMany(CriminalCase::class, 'criminal_case_splited_criminal_case', 'criminal_case_id', 'criminal_case_id1');
    }

    public function bibliography()
    {
        return $this->belongsTo(Bibliography::class, 'bibliography_id');
    }

    public function relation_field()
    {
        return [

            __('content.number_case') => $this->number ?? null,
            __('content.criminal_proceedings_date') => $this->opened_date ? date('d-m-Y', strtotime($this->opened_date)) : null,
            __('content.criminal_code') =>  $this->artical ?? null,
            __('content.materials_management') => $this->opened_agency ? $this->opened_agency->name : null,
            __('content.head_department') => $this->opened_unit_agency ? $this->opened_unit_agency->name : null,
            __('content.instituted_units') => $this->subunit_agency ? $this->subunit_agency->name : null,
            __('content.name_operatives') => $this->worker ? implode(', ', $this->worker->pluck('name')->toArray()) : null,
            __('content.worker_post') => $this->worker_post ? implode(', ', $this->worker_post->pluck('name')->toArray()) : null,
            __('content.instituted_units') => $this->character ?? null,
            __('content.nature_materials_paint') => $this->opened_dou ?? null,
            __('content.initiated_dow') => $this->resource->name ?? null,
            __('content.created_at') => $this->created_at ? date('d-m-Y', strtotime($this->created_at)) : null,



        ];
    }

}
