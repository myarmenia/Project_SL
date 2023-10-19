<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OpenController extends Controller
{
    public function index($lang, $page)
    {
        $find_text = str_contains($page, '_');

        if ($find_text && $page != 'work_activity') {
            $model_name = str_replace('_', '', ucwords($page, '_'));
        }
        else{
            $model_name = $page;
        }

        if ($page == 'man' || $page == 'bibliography') {
            $model_name =  ucfirst($model_name) . '\\' . ucfirst($model_name);
        } else if ($page == 'work_activity') {
            $model_name = ucfirst('OrganizationHasMan');
        } else {
            $model_name =  ucfirst($model_name);
        }

        $model = app('App\Models\\' . $model_name);

        $data = $model::all();

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
}
