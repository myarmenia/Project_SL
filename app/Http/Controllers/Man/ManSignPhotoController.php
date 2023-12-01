<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManExternalSignPhotoCreateRequest;
use App\Models\Man\Man;
use App\Models\ManExternalSignHasSignPhoto;
use App\Services\SignPhotoService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManSignPhotoController extends Controller
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
     * @param $langs
     * @return View|Factory|Application
     */
    public function create($langs): View|Factory|Application
    {
        $modelData = HelpersTraits::getModelFromUrl();

        return view('external-signs-image.index', compact('modelData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManExternalSignPhotoCreateRequest  $request
     * @return RedirectResponse
     */
    public function store($langs, ManExternalSignPhotoCreateRequest $request): RedirectResponse
    {
        $modelData = HelpersTraits::getModelFromUrl();

        SignPhotoService::store($modelData, $request->validated());

        return redirect()->route($modelData->name.'.edit',$modelData->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $langs
     * @param  ManExternalSignHasSignPhoto  $externalSignHasSignPhoto
     * @return Application|Factory|View
     */
    public function edit($langs, ManExternalSignHasSignPhoto $externalSignHasSignPhoto)
    {
        dd($externalSignHasSignPhoto);
        $edit = true;
        $modelData = HelpersTraits::getModelFromUrl();



        return view('external-signs-image.index', compact('modelData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($langs, Request $request,)
    {

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
