<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManPhoneCreateRequest;
use App\Models\Phone;
use App\Services\PhoneService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PhoneController extends Controller
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
     * @return Application|Factory|View
     */
    public function create($langs): View|Factory|Application
    {
        $modelData = HelpersTraits::getModelFromUrl();

        return view('phone.index', compact('modelData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManPhoneCreateRequest  $request
     * @return RedirectResponse
     */
    public function store($langs, ManPhoneCreateRequest $request): RedirectResponse
    {
        $modelData = HelpersTraits::getModelFromUrl();

        PhoneService::store($modelData, $request->validated());

        return redirect()->route($modelData->name.'.edit',$modelData->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return Response
     */
    public function show(Phone $phone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return Response
     */
    public function edit(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phone  $phone
     * @return Response
     */
    public function update(Request $request, Phone $phone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone  $phone
     * @return Response
     */
    public function destroy(Phone $phone)
    {
        //
    }
}
