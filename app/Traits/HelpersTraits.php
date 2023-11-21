<?php

namespace App\Traits;

trait HelpersTraits
{
    public static function previousUrlModel(): object
    {
        $route = app('router')->getRoutes()->match(app('request')->create(url()->previous()));
        $main_route = $route->getName();
        $model = explode('.', $main_route )[0];
        $id = $route->$model;

        $getModel = new class{};

        $getModel->model = self::getModel($model,$id);

        $getModel->id = $id;
        $getModel->main_route = $main_route;

        return $getModel;
    }

    public static function getModelFromUrl(): object
    {
        $getModel = new class{};
        $getModel->model = self::getModel(request()->route()->parameters['model'],request()->route()->parameters['id']);
        $getModel->id = request()->route()->parameters['id'];
        $getModel->name = request()->route()->parameters['model'];

        return $getModel;
    }

    public static function getModel($model,$id){
        if ($model === 'man' || $model === 'bibliography') {
            $result = (app('App\Models\\'.ucfirst($model) . '\\' . ucfirst($model)))::find($id);
        }else{
            $result  = (app('App\Models\\'.ucfirst($model)))::find($id);
        }
        return $result;
    }
}