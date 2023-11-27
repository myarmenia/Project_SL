<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperationalInterestCreateRequest;
use App\Models\Man\Man;
use App\Models\Organization;
use App\Services\OperationalInterestService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class OperationalInterestController extends Controller
{
    public function create($lang, Request $request): View
    {
        $modelData = HelpersTraits::getModelFromUrl();
        $redirect = $request->redirect;
        $teg = null;
        if (isset($request->model_name)) {
            if ($request->model_name === 'man') {
                $teg = Man::find($request->model_id);
            } else {
                $teg = Organization::find($request->model_id);
            }
        }

        return view('operation-interest.index', compact('modelData', 'teg','redirect'));
    }

    /**
     * @param $lang
     * @param  OperationalInterestCreateRequest  $request
     * @param $model
     * @param $id
     * @param $redirect
     * @return RedirectResponse
     */
    public function store($lang, OperationalInterestCreateRequest $request): RedirectResponse
    {
        $modelData = HelpersTraits::getModelFromUrl();
        OperationalInterestService::store($modelData->id, $request->validated(), $modelData->name);
        return redirect()->route($modelData->redirect.'.edit', $modelData->id);
    }
}
