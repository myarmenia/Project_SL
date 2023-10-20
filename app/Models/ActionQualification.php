<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionQualification extends Model
{
    use HasFactory;

    protected $table = 'action_qualification';

    public function action() {
        return $this->belongsToMany(Action::class, 'action_has_qualification','action_id', 'qualification_id');
    }
}
