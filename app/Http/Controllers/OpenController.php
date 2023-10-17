<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenController extends Controller
{
    public function index($lang, $page) {
        
        return view('open.' . $page, compact('page'));
    }

    public function restore($lang, $page, $id) {
        // $model = app('App\Models\\' . ucfirst($page) . '\\' . ucfirst($page));
        // $data = $model::find($id);

        return view('regenerate.' . $page);
    }
}
