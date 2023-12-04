<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationHasCreateRequest;
use App\Models\Man\Man;
use App\Models\Organization;
use App\Models\OrganizationHasMan;
use App\Services\OrganizationHasService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrganizationHasController extends Controller
{
    /**
     * @param $lang
     * @param  Request  $request
     * @return View
     */
    public function create($lang, Request $request): View
    {
        $modelData = HelpersTraits::getModelFromUrl();

        $teg = null;
        if (isset($request->model_name)) {
            if ($request->model_name === 'organization') {
                $teg = Organization::find($request->model_id);
            } else {
                $teg = Man::find($request->model_id);
            }
        }

        return view('work-activity.index', compact('modelData', 'teg'));
    }

    public function edit($lang, OrganizationHasMan $organizationHasMan, Request $request)
    {
        $modelData = HelpersTraits::getModelFromUrl($organizationHasMan);

        $teg = null;
        if ($request->model === 'man') {
            $teg = Organization::find($organizationHasMan->organization_id);
        } else {
            $teg = Man::find($organizationHasMan->man_id);
        }

        return view('work-activity.index', compact('modelData', 'teg'));
    }

    public function update($lang, OrganizationHasMan $organizationHasMan, OrganizationHasCreateRequest $request)
    {
        OrganizationHasService::update($organizationHasMan, $request->validated());

        return  HelpersTraits::backToRoute('work');
    }

    /**
     * @param $langs
     * @param  OrganizationHasCreateRequest  $request
     * @return RedirectResponse
     */
    public function store($langs, OrganizationHasCreateRequest $request): RedirectResponse
    {
        $modelData = HelpersTraits::getModelFromUrl();

        OrganizationHasService::store($modelData, $request->validated());

        return  HelpersTraits::backToRoute('work');
    }
}
