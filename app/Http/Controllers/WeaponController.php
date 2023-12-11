<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWeaponRequest;
use App\Models\Weapon;
use App\Services\WeaponService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeaponController extends Controller
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
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $modelData = HelpersTraits::getModelFromUrl(new Weapon());

        return view('weapon.index',compact('modelData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateWeaponRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateWeaponRequest $request)
    {
        $modelData = HelpersTraits::getModelFromUrl();

        WeaponService::store($modelData, $request->validated());

        return  HelpersTraits::backToRoute('weapon');
    }

    /**
     * @param $lang
     * @param  Weapon  $weapon
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit($lang, Weapon $weapon)
    {
        $modelData = HelpersTraits::getModelFromUrl($weapon);

        return view('weapon.index', compact('modelData'));
    }

    /**
     * @param $lang
     * @param  CreateWeaponRequest  $request
     * @param  Weapon  $weapon
     * @return RedirectResponse
     */
    public function update($lang,CreateWeaponRequest $request, Weapon $weapon)
    {
        WeaponService::update($weapon,$request->all());

        return  HelpersTraits::backToRoute('weapon');
    }
}
