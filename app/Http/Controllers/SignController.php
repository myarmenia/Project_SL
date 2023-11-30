<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManExternalSignCreateRequest;
use App\Models\Man\Man;
use App\Models\ManExternalSignHasSign;
use App\Services\SignService;
use App\Traits\HelpersTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class SignController extends Controller
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

    public function create($langs, Man $man)
    {
        $edit = false;
        $modelData = HelpersTraits::getModelFromUrl();

        return view('external-signs.edit', compact('man','edit','modelData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManExternalSignCreateRequest  $request
     * @return mixed
     */

    public function store($langs, ManExternalSignCreateRequest $request): mixed
    {
        $modelData = HelpersTraits::getModelFromUrl();

        SignService::store($modelData,$request->validated());

        return redirect()->route($modelData->name.'.edit',$modelData->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $lang
     * @param  ManExternalSignHasSign  $manExternalSignHasSign
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($lang, ManExternalSignHasSign $manExternalSignHasSign)
    {
        $edit = true;

        $modelData = HelpersTraits::getModelFromUrl($manExternalSignHasSign);

        return view('external-signs.edit',compact('manExternalSignHasSign','edit','modelData'));
    }

    /**
     * @param $lang
     * @param  ManExternalSignHasSign  $manExternalSignHasSign
     * @param  ManExternalSignCreateRequest  $request
     * @return RedirectResponse
     */
    public function update($lang, ManExternalSignHasSign $manExternalSignHasSign, ManExternalSignCreateRequest $request )
    {
        $manExternalSignHasSign->update($request->validated());

        if (request()->model) {
            return redirect()->route(request()->model.'.edit', request()->id);
        }

        return redirect()->route('open.page','sign');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
