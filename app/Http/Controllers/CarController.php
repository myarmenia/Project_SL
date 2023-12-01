<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarRequest;
use App\Models\Car;
use App\Models\CarCategory;
use App\Models\CarMark;
use App\Models\Color;
use App\Services\CarService;
use App\Traits\HelpersTraits;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return view('car.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('car.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCarRequest $request)
    {

    $modelData = HelpersTraits::getModelFromUrl();
//        dd($modelData);
    CarService::store($modelData, $request->validated());
        $color_id = null;

        if (isset($request->color_id)) {
            $color = Color::firstOrCreate(
                [
                    'name' => $request->color_id
                ],
                [
                    'name' => $request->color_id
                ]
            );

            $color_id = $color->id;

            $data['color_id'] = $color_id;
        }

        $new_car = Car::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Car $car)
    {
        return view('car.index', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCarRequest $request, $lang, Car $car)
    {
        $color_id = null;
        $data = $request->all();

        $car_category = CarCategory::where('name', $request->category_id)->first();
        $car_mark = CarMark::where('name', $request->mark_id)->first();

        if ($car_category != null) {
            $data['category_id'] = $car_category->id;
        }

        if ($car_mark != null) {
            $data['mark_id'] = $car_mark->id;
        }

        if (isset($request->color_id)) {
            $color = Color::firstOrCreate(
                [
                    'name' => $request->color_id
                ],
                [
                    'name' => $request->color_id
                ]
            );

            $color_id = $color->id;

            $data['color_id'] = $color_id;
        }

        $new_car = $car->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
