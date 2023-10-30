<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'weapon';

    protected $tableFields = ['id', 'category', 'view', 'type', 'model', 'reg_num', 'count'];

    protected $guarded = [];

    public $modelRelations = ['man', 'organization'];

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_weapon');
    }

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organization_has_weapon');
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
