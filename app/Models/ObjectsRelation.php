<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectsRelation extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'objects_relation';

    protected $tableFields = ['id', 'first_object_id', 'second_object_id', 'first_object_type', 'second_obejct_type'];


    public function relation_type()
    {
        return $this->belongsTo(RelationType::class);
    }




}
