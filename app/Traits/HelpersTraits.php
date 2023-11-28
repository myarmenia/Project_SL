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

//    public static function getModelFromUrl(): object
//    {
//        $getModel = new class{};
//        $getModel->model = self::getModel(request()->route()->parameters['model'],request()->route()->parameters['id']);
//        $getModel->id = request()->route()->parameters['id'];
//        $getModel->name = request()->route()->parameters['model'];
//
//        return $getModel;
//    }


    public static function getModelFromUrl(null|object $model = null): object
    {
        $getModel = new class{};
        $getModel->model = $model ?: (request()->model ? self::getModel(
            request()->model,
            request()->id
        ) : null);
        $getModel->id = request()->id;
        $getModel->name = request()->model;
        $getModel->redirect = request()->redirect ?? $getModel->name;
        return $getModel;
    }


    public static function getModel($model,$id){
        if ($model === 'man' || $model === 'bibliography') {
            $result = (app('App\Models\\'.ucfirst($model) . '\\' . ucfirst($model)))::find($id);
        }else{
            $result = (app('App\Models\\'.ucfirst($model)))::find($id);
        }
        return $result;
    }

    public static function getPreviousUrl(): object
    {
        $getRoute = new class{};
        $getRoute->previousUrl = app('router')->getRoutes()->match(app('request')->create(url()->previous()));
        $getRoute->previousParams = ['as' => $getRoute->previousUrl->action['as'],'page' =>  $getRoute->previousUrl->parameters['page'] ?? $getRoute->previousUrl->parameters ];
        return $getRoute;
    }
}
