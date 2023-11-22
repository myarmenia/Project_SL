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
        'duration_id',
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
        'duration_id',
        'goal_id',
        'terms_id',
        'aftermath_id',
        'action_qualification_id',
        'address_id',
        'bibliography_id',
        'start_date',
        'end_date',
        'source',
        'opened_dou',
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

    public function man()
    {
        return $this->belongsToMany(Man::class, 'action_has_man');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'action_has_organization');
    }

    public function phone()
    {
        return $this->belongsToMany(Phone::class, 'action_has_phone');
    }

    public function event()
    {
        return $this->belongsToMany(Event::class, 'action_has_event');
    }

    public function weapon()
    {
        return $this->belongsToMany(Weapon::class, 'action_has_weapon');
    }

    public function car()
    {
        return $this->belongsToMany(Car::class, 'action_has_car');
    }

    public function criminal_case()
    {
        return $this->belongsToMany(CriminalCase::class, 'action_has_criminal_case');
    }

    public function action()
    {
        $relation1 =  $this->belongsToMany(Action::class, 'action_to_action', 'action_id1', 'action_id2');
        $relation2 = $this->belongsToMany(Action::class, 'action_to_action', 'action_id1', 'action_id2');

        return $relation1->union($relation2);
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }


    public function relation_field()
    {
        return [
            __('content.content_materials_actions') => $this->material_content ? implode(', ', $this->material_content->pluck('content')->toArray()) : null,
            __('content.start_action_date') => $this->start_date ?? null,
            __('content.end_action_date') =>  $this->end_date ?? null,
            __('content.duration_action') => $this->duration ? $this->duration->name : null,
            // __('content.purpose_motive_reason') => '' ?? null,
            __('content.terms_actions') => $this->terms ? $this->terms->name : null,
            __('content.ensuing_effects') => $this->aftermath ? $this->aftermath->name : null,
            __('content.source_information_actions') => $this->sourc ?? null,
            __('content.opened_dou') => $this->opened_dou ?? null,
            __('content.qualification_fact') => $this->qualification ? implode(', ', $this->qualification->pluck('name')->toArray()) : null,
        ];
    }


    public function setStartDateAttribute($value, $model)
    {
        dd($value, $model);
//        start_date
    }
}
