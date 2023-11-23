<?php

namespace App\Http\Controllers;

use App\Services\Filter\ResponseResultService;
use App\Services\Relation\ModelRelationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OpenController extends Controller
{
    public function index($lang, $page)
    {
        if ($page == 'sign') {
            $model_name = ucfirst('ManExternalSignHasSign');
            $model = app('App\Models\\' . $model_name);
        } else {
            $model = ModelRelationService::get_model_class($page);
        }

        $data = $model::orderBy('id', 'desc')->paginate(20);

        return view('open.' . $page, compact('page', 'data'));
    }

    public function optimization($lang, $page)
    {
        if ($page == 'sign') {
            $model_name = ucfirst('ManExternalSignHasSign');
            $model = app('App\Models\\' . $model_name);
        } else {
            $model = ModelRelationService::get_model_class($page);
        }

        $result = $model::with($model->relation)->get()->toArray();

        $finish_data = ResponseResultService::get_result($result, $model, 'optimization');

        $ids = [];
        foreach ($finish_data['data'] as $f_data) {
            foreach ($f_data as $key => $value) {
                $isNullPresent = true;

                if ($key !== 'id') {
                    if ($value !== null) {
                        $isNullPresent = false;
                        break;
                    }
                }
            }

            if ($isNullPresent) {
                array_push($ids, $f_data['id']);
            }
        }

        $data = $model::whereIn('id', $ids)->orderBy('id', 'desc')->get();

        return view('open.' . $page, compact('page', 'data'));
    }

    public function redirect($lang, Request $request): RedirectResponse
    {
        return redirect()->route($request->main_route, ['model' => $request->route_name, 'id' => $request->route_id, 'model_name' => $request->model, 'model_id' => $request->model_id, 'redirect' => $request->redirect]);
    }
}
