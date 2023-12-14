<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ActionQualification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'action_qualification';

    public function action() {
        return $this->belongsToMany(Action::class, 'action_has_qualification','action_id', 'qualification_id');
    }
}
