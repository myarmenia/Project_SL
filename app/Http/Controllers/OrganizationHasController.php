<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationHasCreateRequest;
use App\Models\Man\Man;
use App\Models\Organization;
use App\Models\Worker;
use App\Services\OrganizationHasService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class OrganizationHasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $lang
     * @param  Man  $man
     * @return View
     */
    public function create($lang, Man $man): View
    {
        Session::put('route', 'organization.create');
        Session::put('model', $man);

        $modelData = HelpersTraits::getModelFromUrl();

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return Response
     */
    public function edit(Worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return Response
     */
    public function update(Request $request, Worker $worker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return Response
     */
    public function destroy(Worker $worker)
    {
        //
    }
}
