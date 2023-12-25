<?php

namespace App\Services\Relation;

use App\Traits\HelpersTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class AddRelationService
{
    // public static function  page_redirect(){

    //     $model = HelpersTraits::previousUrlModel();

    //     Session::put('main_route', $model->main_route);
    //     Session::put('model_id', $model->id);
    //     Session::put('relation', request()->relation);

    //     return redirect()->route('open.page', request()->table_route);

    // }

    public static function add_relation(Request $request): RedirectResponse
    {
        $newData = [$request['fieldName'] => $request['id']];
        $relation = $request->relation ?? null;

        $main_route = $request->main_route;
        $model = explode('.', $main_route)[0];
        $id = $request->model_id;
        $mainModel = ModelRelationService::get_model_class($model);
        $dataModel = $mainModel->find($id);
        $request[$request['fieldName']] = $request['id'];
        $relation_type = class_basename($mainModel->{$relation}());
        $hasColumn = Schema::hasColumn($model, $request['fieldName']);

        if ($relation_type === 'BelongsToMany') {
            $request->validate([
                $request['fieldName'] => [
                    'required',
                    Rule::unique($dataModel->$relation()->getTable(), $dataModel->$relation()->getRelatedPivotKeyName())
                        ->where(function ($query) use ($id, $dataModel, $relation) {
                            $query->where($dataModel->$relation()->getForeignPivotKeyName(), $id);
                        }),
                ],
            ]);

            if(!$dataModel->$relation()->get()->contains($request['id'])){
                $dataModel->$relation()->attach($request['id']);
            }
            else{
                return redirect()->back()->with('error_message', 11111);
            }

        }elseif ($hasColumn && $relation_type == 'BelongsTo'){
            $dataModel->update($newData);
        }


        // elseif ($relation->type === 'attach_relation') {
        //     // $mainModel->$table()->attach($data->id);
        //     // $newModel = app('App\Models\\'.$model)::find($data->id);
        // }
        // session()->forget('main_route');
        return redirect()->route($main_route, $id);
    }

    public static function add_objects_relation(Request $request): RedirectResponse
    {
       $model=  HelpersTraits::getModelFromUrl()->model;

       $relation = $request['relation'];
        if (!$model->$relation->contains($request['relation_id'])){
            $model->$relation()->attach($request['relation_id']);
        }

       return redirect()->route($request['main_route'], $request['relation_id']);
    }
}
