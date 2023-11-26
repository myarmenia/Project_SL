<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationHasCreateRequest;
use App\Models\Man\Man;
use App\Models\Organization;
use App\Services\OrganizationHasService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrganizationHasController extends Controller
{
    /**
     * @param $lang
     * @param  Request  $request
     * @return View
     */
    public function create($lang,Request $request): View
    {
        $modelData = HelpersTraits::getModelFromUrl();
        $redirect = $request->redirect;

        $teg = null;
        if (isset($request->model_name)) {
            if ($request->model_name === 'organization') {
                $teg = Organization::find($request->model_id);
            } else {
                $teg = Man::find($request->model_id);
            }
        }
//        dd($request->model_name,$teg);
        return view('work-activity.index', compact('modelData','teg','redirect'));
    }

    /**
     * @param $langs
     * @param  OrganizationHasCreateRequest  $request
     * @param $model
     * @param $id
     * @param $redirect
     * @return RedirectResponse
     */
    public function store($langs, OrganizationHasCreateRequest $request): RedirectResponse
    {

        $modelData = HelpersTraits::getModelFromUrl();

        OrganizationHasService::store($modelData, $request->validated());

        return redirect()->route($modelData->name.'.edit',$modelData->id);
    }
}
