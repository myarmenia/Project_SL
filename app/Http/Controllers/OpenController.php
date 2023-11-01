<?php

namespace App\Http\Controllers;

use App\Services\Relation\ModelRelationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class OpenController extends Controller
{
    public function index($lang, $page)
    {
        $model = ModelRelationService::get_model_class($page);

        $data = $model::orderBy('id', 'desc')->paginate(15);

        return view('open.' . $page, compact('page', 'data'));
    }

    public function restore($lang, $page, $id)
    {
        $find_text = str_contains($page, '_');

        if ($find_text) {
            $page = str_replace('_', '', ucwords($page, '_'));
        }

        if ($page == 'man' || $page == 'bibliography') {
            $model_name =  ucfirst($page) . '\\' . ucfirst($page);
        } else if ($page == 'WorkActivity') {
            $model_name = ucfirst('OrganizationHasMan');
        } else {
            $model_name =  ucfirst($page);
        }

        $model = app('App\Models\\' . $model_name);

        $data = $model::all();

        return view('regenerate.' . $page, compact('page', 'data'));
    }

    public function redirect($lang, int $id): RedirectResponse
    {
        $route = Session::get('route');
        $model = Session::get('model');

        session()->forget('route');
        Session::put('modelId', $id);

        return redirect()->route($route, [$model->getTable() => $model]);
    }
}
