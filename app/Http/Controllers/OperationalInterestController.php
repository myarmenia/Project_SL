<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperationalInterestCreateRequest;
use App\Models\Man\Man;
use App\Models\Organization;
use App\Services\OperationalInterestService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class OperationalInterestController extends Controller
{
    public function create($lang): View
    {
        $modelData = HelpersTraits::getModelFromUrl();
//        dd($modelData);
//        Session::put('route', 'operational-interest.create');
//        Session::put('model', $man);
        Session::put('modelId', 1);

        $teg = Session::get('modelId');
        if ($teg){
            if ($modelData->name === 'man'){
                $teg = Organization::find($teg);
            }else{
                $teg = Man::find($teg);
            }
        }

        return view('operation-interest.index', compact('modelData', 'teg'));
    }

    /**
     * @param $lang
     * @param  OperationalInterestCreateRequest  $request
     * @return RedirectResponse
     */
    public function store($lang ,OperationalInterestCreateRequest $request): RedirectResponse
    {
        $modelData = HelpersTraits::getModelFromUrl();

        OperationalInterestService::store($modelData->id, $request->validated(),$modelData->name);

        return redirect()->route($modelData->name.'.edit',$modelData->id);
    }
}
