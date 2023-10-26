<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Man\Man;
use App\Models\RelationType;
use App\Services\Relation\ModelRelationService;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class ModelRelationController extends Controller
{
    public function get_relations(Request $request)
    {

        // $data = ModelRelationService::model_relation($request->table_name, $request->model_id);
        $data = ModelRelationService::model_relation('man', 1);

        dd($data);
        return response()->json(['data' => $data]);

    }

    // public function get_relations(Request $request)
    // {

    //     $table_name = 'man';
    //     $find_text = str_contains($table_name, '_');

    //     if ($find_text && $table_name != 'work_activity') {
    //         $model_name = str_replace('_', '', ucwords($table_name, '_'));
    //     } else {
    //         $model_name = $table_name;
    //     }

    //     if ($table_name == 'man' || $table_name == 'bibliography') {
    //         $model_name =  ucfirst($model_name) . '\\' . ucfirst($model_name);
    //     } else if ($table_name == 'work_activity') {
    //         $model_name = ucfirst('OrganizationHasMan');
    //     } else {
    //         $model_name =  ucfirst($model_name);
    //     }

    //     $model = app('App\Models\\' . $model_name);

    //     // $table_name = 'man';
    //     // $modelname = app('App\Models\\' . ucfirst($table_name) .'\\'. ucfirst($table_name));

    //     // $row = $modelname->with($modelname->modelRelations)->find(2);
    //     $row = $model->with($model->modelRelations)->find(1);

    //     $relations = $row->getRelations();
    //     $data = [];
    //     // $method = 'Car';
    //     // dd($relations);
    //     // dd((new \ReflectionClass($model))->getShortName());
    //     // dd(class_basename($model->{$method}()));

    //     // dd(get_class($model->{$method}()));
    //     // dd($relations['car']);

    //     // $re = $row->with($modelname->modelRelations);
    //     foreach ($relations as $key => $relation) {

    //         $relation = $relation != null ? $relation->toArray() : null;
    //         $relation_fields = [];
    //         $relation_type = class_basename($model->{$key}());
    //         dump($relation_type);
    //         if ((!is_array($relation) && $relation != null) || (is_array($relation) && count($relation) > 0)) {


    //             if ($relation_type == 'BelongsToMany' || $relation_type == 'HasMany') {

    //                 foreach ($relation as $k => $value) {

    //                     $relation_fields['relation_name'] = $key;
    //                     $relation_fields['relation_id'] = $value['id'] ?? null;
    //                     $rel_model = app('App\Models\\' . ucfirst($key))->find($value['id']);
    //                     // dd($value->relation_field);

    //                     $relation_fields['fields'] = $rel_model->relation_field() ?? null;

    //                     // $data['releations'][$k]= $relation_fields;
    //                     array_push($data, $relation_fields);
    //                 }
    //             } else {
    //                 $relation_fields['relation_name'] = $key;
    //                 $relation_fields['relation_id'] = $relation['id'] ?? null;
    //                 $rel_model = app('App\Models\ManBeanCountry')->find($relation['id']);
    //                 $relation_fields['fields'] = $rel_model->relation_field() ?? null;
    //                 array_push($data, $relation_fields);
    //             }

    //             // $data['releations']= $relation_fields;
    //             // dump(is_array($relation));
    //             // dump('ka');
    //         }
    //         //    else{

    //         //     dump('chka');
    //         //    }
    //     }

    //     dd($data);
    //     // dd($row->getRelations());
    //     dd($row->getRelations());
    // }
}
