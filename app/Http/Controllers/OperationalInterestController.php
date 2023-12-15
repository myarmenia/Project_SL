<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperationalInterestCreateRequest;
use App\Http\Requests\OperationalInterestUpdateRequest;
use App\Models\Man\Man;
use App\Models\ObjectsRelation;
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
        $modelData = HelpersTraits::getModelFromUrl(new ObjectsRelation());
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
     * @return RedirectResponse
     */
    public function store($lang, OperationalInterestCreateRequest $request): RedirectResponse
    {
        $modelData = HelpersTraits::getModelFromUrl();

        OperationalInterestService::store($modelData->id, $request->validated(), $modelData->name, $request->model_relation);

        return redirect()->route($modelData->redirect.'.edit', $modelData->id);
    }

    public function edit($lang, ObjectsRelation $objectsRelation){
        $modelData = HelpersTraits::getModelFromUrl($objectsRelation);

        $redirect = request()->redirect;
////        $teg = null;
//        dd($objectsRelation->first_obj_relation);
////        if (isset($request->model_name)) {
////            if ($request->model_name === 'man') {
////                $teg = Man::find($request->model_id);
////            } else {
////                $teg = Organization::find($request->model_id);
////            }
////        }
//dd($teg);
        return view('operation-interest.index', compact('modelData', 'redirect'));
    }

    public function update($lang, ObjectsRelation $objectsRelation, OperationalInterestUpdateRequest $request){
        OperationalInterestService::update($objectsRelation, $request->validated());

        return HelpersTraits::backToRoute('objectsRelation',$request->redirect);
    }
}
