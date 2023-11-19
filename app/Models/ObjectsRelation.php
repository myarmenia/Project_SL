<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObjectsRelation extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'objects_relation';

    protected $fillable = [
        'relation_type_id',
        'first_object_id',
        'second_object_id',
        'first_object_type',
        'second_obejct_type',
    ];

    protected $tableFields = ['id', 'first_object_id', 'second_object_id', 'first_object_type', 'second_obejct_type'];

    public $modelRelations = ['man', 'organization'];


    public $relation = [
        'relation_type'
    ];

    public $relationColumn = [
        'id',
        'relation_type',
        'first_object_id',
        'second_object_id',
        'first_object_type',
        'second_obejct_type',
    ];


    public function relation_type()
    {
        return $this->belongsTo(RelationType::class);
    }
}
