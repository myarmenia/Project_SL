<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationCreateRequest;
use App\Models\Organization;
use App\Services\OrganizationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganizationController extends Controller
{
    protected OrganizationService $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

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
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        $newOrganization = $this->store();

        return redirect()->route('organization.edit', ['organization' => $newOrganization]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return int
     */
    public function store(): int
    {
        return $this->organizationService->store();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $lang
     * @param  Organization  $organization
     * @return Application|Factory|View
     */
    public function edit($lang, Organization $organization): Application|Factory|View
    {
//        session()->forget('main_route');
//        session()->forget('modelId');
//        $man->load('gender','nation','knows_languages');

        return view('organization.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $lang
     * @param  Organization  $organization
     * @param  OrganizationCreateRequest  $request
     * @return JsonResponse
     */
    public function update($lang, Organization $organization, OrganizationCreateRequest $request)
    {
        $updated_field = $this->organizationService->update($organization, $request->validated());

        return response()->json(['result' => $updated_field]);
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