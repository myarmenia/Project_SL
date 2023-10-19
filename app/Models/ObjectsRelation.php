<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectsRelation extends Model
{
   use HasFactory;

    protected $table = 'objects_relation';

    public function relation_type() {
        return $this->belongsTo(RelationType::class);
    }
}
