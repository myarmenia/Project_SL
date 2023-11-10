<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'action';

    protected $relationFields = ['duration', 'goal', 'terms', 'aftermath'];

    protected $tableFields = ['id', 'source', 'opened_dou'];

    protected $hasRelationFields = ['material_content', 'action_qualification'];

    protected $manyFilter = ['start_date', 'end_date'];

    protected $count = ['man_count'];

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
    public function signal(){
        return $this->belongsToMany(Signal::class,'action_passes_signal');
    }
}
