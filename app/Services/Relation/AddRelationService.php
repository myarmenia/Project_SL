<?php

namespace App\Services\Relation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use ReflectionClass;

class AddRelationService
{
    public static function  page_redirect(){
        // dd(request()->route()->id);

        Session::put('main_route', request()->main_route);
        Session::put('model_id', request()->id);

        return redirect()->route('open.page', request()->table_route);

    }

    public static function add_relation(){
        $relation = request();

        $newData = [$relation->fieldName => $relation->id];
        $table = $relation->table_name ?? null;

        $main_route = Session::get('main_route');
        $model =  explode('.', Session::get('main_route'));
        $id =  Session::get('model_id');


        $mainModel = ModelRelationService::get_model_class($model[0]);
        $dataModel = $mainModel->find($id);

        $relation_type = class_basename($mainModel->{$table}());
        $hasColumn = Schema::hasColumn($model[0], $relation->fieldName);

        if ( $hasColumn && $relation_type == 'BelongsTo') {
            $dataModel->update($newData);
        }

        if($relation_type == 'BelongsToMany') {
            $dataModel->$table()->attach($relation->id);
        }

        // elseif ($relation->type === 'attach_relation') {
        //     // $mainModel->$table()->attach($data->id);
        //     // $newModel = app('App\Models\\'.$model)::find($data->id);
        // }
        session()->forget('main_route');

        return redirect()->route($main_route, $id);

    }






}
