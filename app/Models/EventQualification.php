<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EventQualification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_qualification';

    public function event()
    {
        return $this->belongsToMany(Event::class, 'event_has_qualification','event_id', 'qualification_id');
    }

}
