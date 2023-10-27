<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organization';

    protected $fillable = [

    ];

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
