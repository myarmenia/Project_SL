<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OpenController extends Controller
{
    public function index($lang, $page) {

        $model = app('App\Models\\' . ucfirst($page) . '\\' . ucfirst($page));
        $data = $model::all();

        return view('open.' . $page, compact('page', 'data'));
    }

    public function restore($lang, $page, $id) {
        $model = app('App\Models\\' . ucfirst($page) . '\\' . ucfirst($page));
        $data = $model::find($id);

        return view('open.' . $page, compact('page', 'data'));

    }


}
