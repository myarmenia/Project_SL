<?php

namespace App\Models;


use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'phone';

    protected $fillable = [
        'number',
        'more_data',
    ];

    protected $tableFields = ['id', 'number', 'more_data'];

    protected $hasRelationFields = ['character'];

    public $modelRelations = ['man', 'organization','action'];

    public $relation = ['character'];

    protected $manyFilter = ['created_at'];

    public $relationColumn = [
        'id',
        'number',
        'character',
        'more_data',
        'created_at'
    ];

    public function character()
    {
        return $this->belongsToMany(Character::class, 'man_has_phone');
    }

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_phone');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organization_has_phone');
    }

    public function action()
    {
        return $this->belongsToMany(Action::class, 'action_has_phone');
    }

    public function all_relation(){
        // return  ['man' ,'organization', ]
        // $relation1 =  $this->man()->select('man.id');
        // $relation2 = $this->organization()->select('organization.id');

        // return $relation1->union($relation2);
    }

    public function relation_field()
    {
        return [
            __('content.phone_number') => $this->number ?? null,
            __('content.additional_data') => $this->more_data ?? null,

        ];
    }

}
