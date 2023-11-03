<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriminalCase extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'criminal_case';


    protected $relationFields = ['opened_agency', 'opened_unit_agency', 'subunit_agency '];

    protected $tableFields = ['id', 'number', 'artical', 'character', 'opened_dou'];

    protected $manyFilter = ['opened_date'];

    protected $hasRelationFields = ['worker', 'worker_post'];

    public $relation = [
        'opened_agency',
        'opened_unit_agency',
        'subunit_agency',
        'worker',
        'worker_post',
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

    public function man_count() {
        return $this->belongsToMany(Man::class, 'criminal_case_has_man')->count();
    }
}
