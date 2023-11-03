<?php

namespace App\Models;

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


    public function event_qualification() {
        return $this->belongsToMany(EventQualification::class, 'event_has_qualification','event_id', 'qualification_id');
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
}
