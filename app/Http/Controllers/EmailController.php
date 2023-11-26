<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManEmailCreateRequest;
use App\Models\Email;
use App\Services\EmailService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailController extends Controller
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

        return view('email.index', compact('modelData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManEmailCreateRequest  $request
     * @return RedirectResponse
     */
    public function store($langs, ManEmailCreateRequest $request): RedirectResponse
    {
        dd(request()->route()->parameters['model'],request()->route()->parameters['id']);
        $modelData = HelpersTraits::getModelFromUrl();

        EmailService::store($modelData, $request->validated());

        return redirect()->route($modelData->name.'.edit',$modelData->id);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($langs)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
