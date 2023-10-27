<?php

namespace App\Models;


use App\Models\Man\Man;

use App\Traits\FilterTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'organization';

    protected $relationFields = ['country', 'category', 'country_ate'];

    protected $tableFields = ['id', 'name', 'employers_count', 'attension', 'opened_dou'];

    protected $manyFilter = ['reg_date'];

    protected $guarded = [];

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function country_ate()
    {
        return $this->belongsTo(CountryAte::class, 'country_ate_id');
    }

    public function category() {
        return $this->belongsTo(OrganizationCategory::class, 'category_id');
    }

    public function man() {
        return $this->belongsToMany(Man::class, 'organization_has_man');
    }
}
