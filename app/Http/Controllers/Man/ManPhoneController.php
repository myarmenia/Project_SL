<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManPhoneCreateRequest;
use App\Models\Man\Man;
use App\Models\Phone;
use App\Services\PhoneService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManPhoneController extends Controller
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
     * @param  Man  $man
     * @return Application|Factory|View
     */
    public function create($langs, Man $man): View|Factory|Application
    {
        return view('phone.phone', compact('man'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManPhoneCreateRequest  $request
     * @param  Man  $man
     * @return RedirectResponse
     */
    public function store($langs, ManPhoneCreateRequest $request, Man $man): RedirectResponse
    {
        PhoneService::store($man, $request->validated());

        return redirect()->route('man.edit',$man->id);
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
