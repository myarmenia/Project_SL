<?php

namespace App\Services\Relation;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AddRelationService
{
    public static function  page_redirect(){

        $route = app('router')->getRoutes()->match(app('request')->create(url()->previous()));
        $main_route = $route->getName();
        $model = explode('.', $main_route )[0];
        $id = $route->$model;

        Session::put('main_route', $main_route);
        Session::put('model_id', $id);
        Session::put('relation', request()->relation);


        return redirect()->route('open.page', request()->table_route);

    }

    public static function add_relation(Request $request): RedirectResponse
    {

        $newData = [$request['fieldName'] => $request['id']];
        $relation = $request->relation ?? null;

        $main_route = Session::get('main_route');
        $model =  explode('.', Session::get('main_route'))[0];
        $id =  Session::get('model_id');

        $mainModel = ModelRelationService::get_model_class($model);
        $dataModel = $mainModel->find($id);
        $request[$request['fieldName']] = $request['id'];

        $request->validate([
            $request['fieldName'] => [
                'required',
                Rule::unique($dataModel->$relation()->getTable(), $dataModel->$relation()->getRelatedPivotKeyName())
                    ->where(function ($query) use ($id, $dataModel, $relation) {
                        $query->where($dataModel->$relation()->getForeignPivotKeyName(), $id);
                    }),
            ],
        ]);


        $relation_type = class_basename($mainModel->{$relation}());
        $hasColumn = Schema::hasColumn($model, $request['fieldName']);


        if ( $hasColumn && $relation_type == 'BelongsTo') {
            $dataModel->update($newData);
        }

        if($relation_type == 'BelongsToMany') {
            if(!$dataModel->$relation()->get()->contains($request['id'])){
                $dataModel->$relation()->attach($request['id']);
            }
            else{
                return redirect()->back()->with('error_message', 11111);
            }
        }

        // elseif ($relation->type === 'attach_relation') {
        //     // $mainModel->$table()->attach($data->id);
        //     // $newModel = app('App\Models\\'.$model)::find($data->id);
        // }
        session()->forget('main_route');

        return redirect()->route($main_route, $id);

    }






}
