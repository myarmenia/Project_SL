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
     * Show the form for creating a new resource.
     *
     * @param $lang
     * @return View
     */
    public function create($lang,Request $request): View
    {
        dd(explode('.',$request->getRequestUri())[0]);
        Session::put('route', 'operational-interest.create');
//        Session::put('model', $man);
        dd(url()->current()->segment(4));
        $modelData = HelpersTraits::getModelFromUrl();

//        Session::put('modelId', 1);
        $teg = Session::get('modelId');
        if ($teg){
            if ($modelData->name === 'man'){
                $teg = Organization::find($teg);
            }else{
                $teg = Man::find($teg);
            }
        }

        return view('work-activity.index', compact('modelData','teg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  OrganizationHasCreateRequest  $request
     * @return RedirectResponse
     */
    public function store($langs, OrganizationHasCreateRequest $request): RedirectResponse
    {
        $modelData = HelpersTraits::getModelFromUrl();

        OrganizationHasService::store($modelData, $request->validated());

        return redirect()->route($modelData->name.'.edit',$modelData->id);
    }
}
