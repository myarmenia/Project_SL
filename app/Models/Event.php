<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'event';

    protected $guarded = [];

    protected $relationFields = ['aftermath', 'resource', 'agency'];

    protected $tableFields = ['id', 'result'];

    protected $hasRelationFields = ['event_qualification'];

    protected $manyFilter = ['date'];

    public $relation = [
        'event_qualification',
        'aftermath',
        'agency',
        'resource',
    ];

    public $relationColumn = [
        'id',
        'event_qualification',
        'date',
        'aftermath',
        'result',
        'agency',
        'resource',
    ];


    public function event_qualification()
    {
        return $this->belongsToMany(EventQualification::class, 'event_has_qualification', 'event_id', 'qualification_id');
    }

    public function aftermath()
    {
        return $this->belongsTo(Aftermath::class, 'aftermath_id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'event_has_organization');
    }

    public function man()
    {
        return $this->belongsToMany(Man::class, 'event_has_man');
    }

    public function car()
    {
        return $this->belongsToMany(Car::class, 'event_has_car');
    }

    public function weapon()
    {
        return $this->belongsToMany(Weapon::class, 'event_has_weapon');
    }

    public function action()
    {
        return $this->belongsToMany(Action::class, 'event_has_action');
    }

    public function bibliography()
    {
        return $this->belongsTo(Bibliography::class, 'bibliography_id');
    }
    public function signal()
    {
        return $this->belongsToMany(Signal::class, 'event_passes_signal');
    }



}
