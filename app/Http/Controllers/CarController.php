<?php

namespace App\Http\Controllers;

use App\Events\ConsistentSearchRelationsEvent;
use App\Http\Requests\CreateCarRequest;
use App\Models\Car;
use App\Models\CarCategory;
use App\Models\CarMark;
use App\Models\Color;
use App\Models\Man\Man;
use App\Services\CarService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $modelData = HelpersTraits::getModelFromUrl();

        return view('car.index', compact('modelData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCarRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateCarRequest $request)
    {

        $modelData = HelpersTraits::getModelFromUrl();
        CarService::store($modelData, $request->validated());

        return  HelpersTraits::backToRoute('car');
    }

    /**
     * @param $lang
     * @param  Car  $car
     * @return Application|Factory|View
     */
    public function edit($lang, Car $car)
    {
        $modelData = HelpersTraits::getModelFromUrl($car);

        return view('car.index', compact('modelData'));
    }

    /**
     * @param $lang
     * @param  CreateCarRequest  $request
     * @param  Car  $car
     * @return RedirectResponse
     */
    public function update($lang,CreateCarRequest $request, Car $car)
    {
//        $modelData = HelpersTraits::getModelFromUrl($car);
//        $modelName = $modelData->name;
//        event(new ConsistentSearchRelationsEvent($car->$modelName()->getTable(), $car->id, '', $modelData->id));

        CarService::update($car, $request->validated());
        return  HelpersTraits::backToRoute('car');
    }
}
