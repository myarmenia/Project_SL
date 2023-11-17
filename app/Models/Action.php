<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'action';

    protected $relationFields = ['duration', 'goal', 'terms', 'aftermath'];

    protected $tableFields = ['id', 'source', 'opened_dou'];

    protected $hasRelationFields = ['material_content', 'action_qualification'];

    protected $manyFilter = ['start_date', 'end_date'];

    protected $count = ['man_count'];

    public $modelRelations = ['man', 'organization', 'event', 'phone', 'weapon', 'car', 'signal', 'criminal_case', 'action', 'address', 'bibliography'];


    public $relation = [
        'duration',
        'goal',
        'terms',
        'aftermath',
        'material_content',
        'action_qualification',
        'man_count1'
    ];

    public $relationColumn = [
        'id',
        'material_content',
        'action_qualification',
        'man_count1',
        'start_date',
        'end_date',
        'duration',
        'goal',
        'terms',
        'aftermath',
        'source',
        'opened_dou',
    ];

    protected $fillable = [
        'start_date',
        'end_date',
        'source',
        'opened_dou',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function material_content()
    {
        return $this->belongsToMany(MaterialContent::class, 'action_has_material_content');
    }

    public function qualification()
    {
        return $this->belongsToMany(ActionQualification::class, 'action_has_qualification', 'action_id', 'qualification_id');
    }

    public function action_qualification()
    {
        return $this->qualification();
    }

    public function qualification_column()
    {
        return $this->belongsTo(ActionQualification::class, 'action_qualification_id');
    }

    public function man_count1()
    {
        return $this->belongsToMany(Man::class, 'action_has_man');
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class, 'duration_id');
    }

    public function goal()
    {
        return $this->belongsTo(ActionGoal::class, 'goal_id');
    }

    public function terms()
    {
        return $this->belongsTo(Terms::class, 'terms_id');
    }

    public function aftermath()
    {
        return $this->belongsTo(Aftermath::class, 'aftermath_id');
    }
    public function signal()
    {
        return $this->belongsToMany(Signal::class, 'action_passes_signal');
    }

    public function bibliography()
    {
        return $this->belongsTo(Bibliography::class, 'bibliography_id');
    }

    public function getStartDateAttribute($value) /* mutator*/
    {
        return $value ? date('Y-m-d', strtotime($value)) : null;
    }

    // public function relation_field()
    // {
    //     return [
    //         __('content.content_materials_actions') => $this->event_qualification ? implode(', ', $this->event_qualification->pluck('name')->toArray()) : null,
    //         __('content.start_action_date') => $this->date ?? null,
    //         __('content.end_action_date') =>  $this->aftermath->name ?? null,
    //         __('content.duration_action') => $this->agency->name ?? null,
    //         __('content.purpose_motive_reason') => $this->result ?? null,
    //         __('content.terms_actions') => $this->resource->name ?? null,



    //         __('content.ensuing_effects') => $this->resource->name ?? null,
    //         __('content.source_information_actions') => $this->resource->name ?? null,
    //         __('content.opened_dou') => $this->resource->name ?? null,
    //         __('content.qualification_fact') => $this->resource->name ?? null,


    //     ];
    // }
}
