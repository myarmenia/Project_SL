<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ObjectsRelation extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'objects_relation';

    // protected $fillable = [
    //     'relation_type_id',
    //     'first_object_id',
    //     'second_object_id',
    //     'first_object_type',
    //     'second_obejct_type',
    // ];
    protected $guarded=[];


    protected $tableFields = ['id', 'first_object_id', 'second_object_id', 'first_object_type', 'second_obejct_type'];

    public $modelRelations = ['first_relation', 'second_relation'];


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



    public function first_relation()
    {
        $obj = $this->find(request()->table_id);

        $model_name =  ucfirst($obj->first_object_type);

        if ($obj->first_object_type == 'man') {
            $model_name =  ucfirst($obj->first_object_type) . '\\' . ucfirst($obj->first_object_type);
        }

        $relation1 = $this->hasOne(app('App\Models\\' . $model_name)::class, 'id', 'first_object_id');

        return  $relation1;

    }


    public function second_relation()
    {

        $obj = $this->find(request()->table_id);

        $model_name =  ucfirst($obj->second_obejct_type);

        if ($obj->second_obejct_type == 'man') {
            $model_name =  ucfirst($obj->second_obejct_type) . '\\' . ucfirst($obj->second_obejct_type);
        }

        $relation2 = $this->hasOne(app('App\Models\\' . $model_name)::class, 'id', 'second_object_id');

        return  $relation2;

    }



}
