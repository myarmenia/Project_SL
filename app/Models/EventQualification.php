<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventQualification extends Model
{
    use HasFactory;

    protected $table = 'event_qualification';

    public function event()
    {
        return $this->belongsToMany(Event::class, 'event_has_qualification','event_id', 'qualification_id');
    }

}
