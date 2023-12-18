<?php

namespace App\Traits;

use Illuminate\Http\RedirectResponse;

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

    public static function getModelFromUrl(null|object $model = null): object
    {
        $getModel = new class{};
        $getModel->model = $model ?: (request()->model || request()->model_name ? self::getModel(
            request()->model ?? request()->model_name ,
            request()->id ?? request()->model_id
        ) : null);
        $getModel->id = request()->id ?? request()->model_id;
        $getModel->name = request()->model;
        $getModel->redirect = request()->redirect ?? $getModel->name;
        $getModel->relation = request()->relation;
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

    public static function backToRoute(string $page = '', $model = null): RedirectResponse
    {
        if ((request()->model|| request()->model_name )|| $model) {
            return redirect()->route(($model ?? request()->model ?? request()->model_name).'.edit', request()->id ??  request()->model_id);
        }
dd(request());
        return redirect()->route('open.page',$page);
    }
}
