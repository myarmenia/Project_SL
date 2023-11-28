<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneCreateRequest;
use App\Http\Requests\PhoneUpdateRequest;
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
        $modelData = HelpersTraits::getModelFromUrl();

        return view('phone.index', compact('modelData'));
    }

    public function edit($lang, Phone $phone)
    {
        $edit = true;

        $showRelation = request()->model;

        $modelData = null;
        if ($showRelation){
            $modelData = HelpersTraits::getModelFromUrl();
        }

        return view('phone.index', compact('modelData','edit','showRelation','phone'));
    }

    public function update($langs,Phone $phone, PhoneUpdateRequest $request)
    {

        $modelData = null;
        if (request()->model){
            $modelData = HelpersTraits::getModelFromUrl();
        }

        PhoneService::update($phone, $request->validated(), $modelData);

        if (request()->model) {
            return redirect()->route(request()->model.'.edit', request()->id);
        }

        return redirect()->route('open.page','phone');
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

        return redirect()->route($modelData->name.'.edit',$modelData->id);
    }
}
