<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneCreateRequest;
use App\Models\Phone;
use App\Services\PhoneService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PhoneController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param $langs
     * @return Application|Factory|View
     */
    public function create($langs): View|Factory|Application
    {
        $showRelation = request()->model;

        $modelData = HelpersTraits::getModelFromUrl(new Phone());

        return view('phone.index', compact('modelData','showRelation'));
    }

    public function edit($lang, Phone $phone)
    {
        $edit = true;

        $showRelation = request()->model;

        $modelData = HelpersTraits::getModelFromUrl($phone);

        return view('phone.index', compact('modelData','edit','showRelation'));
    }

    public function update($langs, Phone $phone, PhoneCreateRequest $request)
    {
        $modelData = HelpersTraits::getModelFromUrl($phone);

        PhoneService::update($phone, $request->validated(), $modelData);

        return  HelpersTraits::backToRoute('phone');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  PhoneCreateRequest  $request
     * @return RedirectResponse
     */
    public function store($langs, PhoneCreateRequest $request): RedirectResponse
    {
        $modelData = HelpersTraits::getModelFromUrl();

        PhoneService::store($modelData, $request->validated());

        return  HelpersTraits::backToRoute('phone');
    }
}
