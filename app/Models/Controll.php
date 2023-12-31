<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Controll extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'control';
    protected $guarded = [];

    protected $relationFields = ['unit', 'doc_category', 'act_unit', 'sub_act_unit', 'controll_result'];

    protected $tableFields = ['id', 'reg_num', 'snb_director', 'snb_subdirector', 'resolution', 'actor_name', 'sub_actor_name'];

    protected $manyFilter = ['creation_date', 'reg_date', 'resolution_date'];

    protected $hasRelationFields = [];

    protected $count = [];

    public $relation = [
        'unit',
        'doc_category',
        'act_unit',
        'sub_act_unit',
        'controll_result'
    ];

    public $relationColumn = [
        'id',
        'unit',
        'doc_category',
        'creation_date',
        'reg_num',
        'reg_date',
        'snb_director',
        'snb_subdirector',
        'resolution_date',
        'resolution',
        'act_unit',
        'actor_name',
        'sub_act_unit',
        'sub_actor_name',
        'controll_result'
    ];



    public $modelRelations = ['bibliography'];

    public function bibliography()
    {
        return $this->belongsTo(Bibliography::class, 'bibliography_id');
    }
    public function unit()
    {
        return $this->belongsTo(Agency::class, 'unit_id');
    }
    public function doc_category()
    {
        return $this->belongsTo(DocCategory::class, 'doc_category_id');
    }
    public function act_unit()
    {
        return $this->belongsTo(Agency::class, 'act_unit_id');
    }
    public function sub_act_unit()
    {
        return $this->belongsTo(Agency::class, 'sub_act_unit_id');
    }
    public function controll_result()
    {
        return $this->belongsTo(ControlResult::class, 'result_id');
    }

    public function relation_field()
    {
        return [
            __('content.unit') => $this->unit ? $this->unit->name : null,
            __('content.document_category') => $this->doc_category ? $this->doc_category->name : null,
            __('content.document_date')  => $this->creation_date ?? null,
            __('content.reg_document')  => $this->reg_num ?? null,
            __('content.date_reg')  => $this->reg_date ?? null,
            __('content.director') => $this->snb_director ?? null,
            __('content.deputy_director') => $this->snb_subdirector ?? null,
            __('content.date_resolution') => $this->resolution_date ?? null,
            __('content.resolution') => $this->resolution ?? null,
            __('content.department_performer') => $this->act_unit ? $this->act_unit->name : null,
            __('content.actor_name') => $this->actor_name ?? null,
            __('content.department_coauthors') => $this->sub_act_unit ? $this->sub_act_unit->name : null,
            __('content.sub_actor_name') => $this->sub_actor_name ?? null,
            __('content.result_execution') => $this->controll_result ? $this->controll_result->name : null,

        ];
    }
}
