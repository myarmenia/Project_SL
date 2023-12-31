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
        $modelData = HelpersTraits::getModelFromUrl(new Car());

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
        CarService::update($car, $request->validated());
        $modelData = HelpersTraits::getModelFromUrl($car);
        $modelName = $modelData->name;
        if( $modelName and $modelData->model->$modelName()) {
            event(new ConsistentSearchRelationsEvent($modelData->model->$modelName()->getTable(),  $modelData->model->id, '',  $modelData->id));
        }
        return  HelpersTraits::backToRoute('car');
    }
}
