<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManBeanCountryCreateRequest;
use App\Models\Locality;
use App\Models\Man\Man;
use App\Models\ManBeanCountry;
use App\Models\Region;
use App\Services\ManBeanCountryService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManBeanCountryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        $modelData = HelpersTraits::getModelFromUrl(new ManBeanCountry);

        return view('being-country.edit', compact('modelData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ManBeanCountryCreateRequest  $request
     * @return RedirectResponse
     */
    public function store(ManBeanCountryCreateRequest $request): RedirectResponse
    {
        $modelData = HelpersTraits::getModelFromUrl();

        ManBeanCountryService::store($modelData, $request->validated());

        return  HelpersTraits::backToRoute('man_bean_country');
    }


    /**
     * @param $lang
     * @param  ManBeanCountry  $manBeanCountry
     * @return Application|Factory|View
     */
    public function edit($lang, ManBeanCountry $manBeanCountry)
    {
        $modelData = HelpersTraits::getModelFromUrl($manBeanCountry);

        return view('being-country.edit', compact('modelData'));
    }

    /**
     * @param $lang
     * @param  ManBeanCountry  $manBeanCountry
     * @param  ManBeanCountryCreateRequest  $request
     * @return RedirectResponse
     */
    public function update($lang, ManBeanCountry $manBeanCountry, ManBeanCountryCreateRequest $request)
    {
        ManBeanCountryService::update($manBeanCountry,$request->validated());

        return  HelpersTraits::backToRoute('man_bean_country');
    }
}
