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


    public function man_count()
    {
        return $this->belongsToMany(Man::class, 'action_has_man')->count();
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
}
