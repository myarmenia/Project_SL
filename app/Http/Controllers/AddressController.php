<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressCreateRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Models\Address;
use App\Models\Man\Man;
use App\Services\AddressService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $modelData = HelpersTraits::getModelFromUrl(new Address());

        return view('person-address.index', compact('modelData'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  AddressCreateRequest  $request
     * @return RedirectResponse
     */
    public function store(AddressCreateRequest $request)
    {
        $modelData = HelpersTraits::getModelFromUrl();

        AddressService::store($modelData, $request->validated(),(request()->relation === 'dummy_address' || request()->model === 'event'));

        return  HelpersTraits::backToRoute('address');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $lang
     * @param  Address  $address
     * @return Application|Factory|View
     */
    public function edit($lang, Address $address)
    {
        $edit = true;

        $modelData = HelpersTraits::getModelFromUrl($address);

        return view('person-address.index', compact('modelData','edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $lang
     * @param  Address  $address
     * @param  AddressUpdateRequest  $request
     * @return RedirectResponse
     */
    public function update($lang, Address $address, AddressUpdateRequest $request)
    {
        AddressService::update($address, $request->validated());

        if (request()->model) {
            return redirect()->route(request()->model.'.edit', request()->id);
        }

        return  HelpersTraits::backToRoute('address');
    }
}
