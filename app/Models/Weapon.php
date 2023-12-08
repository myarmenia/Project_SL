<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Weapon extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'weapon';

    protected $tableFields = ['id', 'category', 'view', 'type', 'model', 'reg_num', 'count'];

    protected $guarded = ['id'];

    public $modelRelations = ['man', 'organization', 'action', 'event'];

    public $relation = [];

    public $relationColumn = [
        'id',
        'category',
        'view',
        'type',
        'model',
        'reg_num',
        'count',
    ];

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_weapon');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organization_has_weapon');
    }

    public function action()
    {
        return $this->belongsToMany(Action::class, 'action_has_weapon');
    }

    public function event()
    {
        return $this->belongsToMany(Event::class, 'event_has_weapon');
    }

    public function relation_field()
    {
        return [
            __('content.weapon_cat') =>  $this->category ?? null,
            __('content.view') => $this->view ?? null,
            __('content.type') => $this->type ?? null,
            __('content.mark') => $this->model ?? null,
            __('content.account_number') => $this->reg_num ?? null,
            __('content.count') => $this->count ?? null,

        ];
    }
}
