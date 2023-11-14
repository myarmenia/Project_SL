<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperationalInterestCreateRequest;
use App\Models\Man\Man;
use App\Services\OperationalInterestService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class OperationalInterest extends Controller
{
    public function create($lang, Man $man): View
    {
        Session::put('route', 'operational-interest.create');
        Session::put('model', $man);

        $teg = Session::get('modelId');
        if ($teg) {

            $teg = app('App\Models\\'.Session::get('main_model'))::find($teg);
dd($teg);
            $teg = Man::find($teg);
        }

        return view('operation-interest.index', compact('man', 'teg'));
    }

    /**
     * @param $lang
     * @param  Man  $man
     * @param  OperationalInterestCreateRequest  $request
     * @return RedirectResponse
     */
    public function store($lang, Man $man,OperationalInterestCreateRequest $request): RedirectResponse
    {
        OperationalInterestService::store($man->id, $request->validated(),'man');

        return redirect()->route('man.edit', $man->id);
    }
}
