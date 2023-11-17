<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManBeanCountryCreateRequest;
use App\Models\Man\Man;
use App\Models\ManBeanCountry;
use App\Services\ManBeanCountryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManBeanCountryController extends Controller
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
     * @return View|Factory|Application
     */
    public function create($langs, Man $man): View|Factory|Application
    {
        return view('being-country.being-country', compact('man'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $lang
     * @param  ManBeanCountryCreateRequest  $request
     * @param  Man  $man
     * @return RedirectResponse
     */
    public function store($lang, ManBeanCountryCreateRequest $request, Man $man): RedirectResponse
    {
        ManBeanCountryService::store($man, $request->validated());

        return redirect()->route('man.edit', $man);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManBeanCountry  $manBeanCountry
     * @return Response
     */
    public function show(ManBeanCountry $manBeanCountry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManBeanCountry  $manBeanCountry
     * @return Response
     */
    public function edit(ManBeanCountry $manBeanCountry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManBeanCountry  $manBeanCountry
     * @return Response
     */
    public function update(Request $request, ManBeanCountry $manBeanCountry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManBeanCountry  $manBeanCountry
     * @return Response
     */
    public function destroy(ManBeanCountry $manBeanCountry)
    {
        //
    }
}
