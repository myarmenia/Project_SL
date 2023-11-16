<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'organization';

    protected $relationFields = ['country', 'category', 'country_ate'];

    protected $tableFields = ['id', 'name', 'employers_count', 'attension', 'opened_dou'];

    protected $manyFilter = ['reg_date'];

    protected $guarded = [];

    public $modelRelations = ['address', 'phone', 'organization', 'car', 'weapon', 'objects_relation_to_first_object', 'objects_relation_to_second_object', 'organization_has_man'];

    public $relation = [
        'country',
        'country_ate',
        'category',
    ];

    public $relationColumn = [
        'id',
        'name',
        'country',
        'reg_date',
        'country_ate',
        'category',
        'employers_count',
        'attension',
        'opened_dou',
    ];


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function country_ate()
    {
        return $this->belongsTo(CountryAte::class, 'country_ate_id');
    }

    public function category()
    {
        return $this->belongsTo(OrganizationCategory::class, 'category_id');
    }

    public function organization_category()
    {
        return $this->category();
    }

    public function man()
    {
        return $this->belongsToMany(Man::class, 'organization_has_man');
    }

    public function address()
    {
        return $this->belongsToMany(Address::class, 'organization_has_address');
    }

    public function dummy_address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function event()
    {
        return $this->belongsToMany(Event::class, 'event_has_organization');
    }

    public function criminal_case()
    {
        return $this->belongsToMany(CriminalCase::class, 'criminal_case_has_organization');
    }

    public function action()
    {
        return $this->belongsToMany(Action::class, 'action_has_organization');
    }

    public function passed()
    {
        return $this->belongsToMany(Signal::class, 'organization_passes_by_signal');
    }

    public function signal(){
        return $this->belongsToMany(Signal::class,'organization_checked_by_signal');
    }

    public function email()
    {
        return $this->belongsToMany(Email::class, 'organization_has_email');
    }

    public function weapon()
    {
        return $this->belongsToMany(Weapon::class, 'organization_has_weapon');
    }

    public function mia_summary()
    {
        return $this->belongsToMany(MiaSummary::class, 'organization_passes_mia_summary');
    }

    public function car()
    {
        return $this->belongsToMany(Car::class, 'organization_has_car');
    }

    public function phone()
    {
        return $this->belongsToMany(Phone::class, 'organization_has_phone');
    }


    public function organization_has_man()
    {
        return $this->hasMany(OrganizationHasMan::class);
    }


    public function organization()
    {

        $relation1 =  $this->belongsToMany(Organization::class, 'organization_to_organization', 'organization_id2', 'organization_id1');
        $relation2 = $this->belongsToMany(Organization::class, 'organization_to_organization', 'organization_id1', 'organization_id2');

        return $relation1->union($relation2);
    }

    public function organization_to_organization(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'organization_to_organization', 'organization_id1', 'organization_id2');
    }


    public function objects_relation_to_first_object()
    {
        return $this->hasMany(ObjectsRelation::class, 'first_object_id')->where('first_object_type', 'organization');

    }

    public function objects_relation_to_second_object()
    {
        return $this->hasMany(ObjectsRelation::class, 'second_object_id')->where('second_obejct_type', 'organization');

    }


    public function bibliography()
    {
        return $this->belongsToMany(Bibliography::class, 'organization_has_bibliography');
    }


    public function relation_field()
    {
        return [
            __('content.country') => $this->country ? $this->country->name : null,
            __('content.category_organization') => $this->organization_category ? $this->organization_category->name : null,
            __('content.country_ate') => $this->country_ate ? $this->country_ate->name : null,
            __('content.name_organization') => $this->name ?? null,
            __('content.date_formation') => $this->reg_date ? date('d-m-Y', strtotime($this->reg_date)) : null,
            __('content.number_worker') => $this->employers_count ?? null,
            __('content.attention') => $this->attention ?? null,
            __('content.opened_dou') => $this->opened_dou ?? null,
            __('content.security_organization') => $this->agency ? $this->agency->name : null,

        ];
    }
    public function organization_passes_by_signal()
    {
        return $this->belongsToMany(Signal::class, 'organization_passes_by_signal');
    }


}
