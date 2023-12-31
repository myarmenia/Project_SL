<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManOrganizationCreateRequest;
use App\Models\Man\Man;
use App\Models\Worker;
use App\Services\OrganizationHasManService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganizationHasManController extends Controller
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
        $manId = $man->id;

        return view('organization.organization', compact('manId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManOrganizationCreateRequest  $request
     * @param  Man  $man
     * @return RedirectResponse
     */
    public function store($langs, ManOrganizationCreateRequest $request, Man $man): RedirectResponse
    {
        OrganizationHasManService::store($man, $request->validated());

        return redirect()->route('man.edit',$man->id);
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
