<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationalInterestCreateRequest;
use App\Models\Man\Man;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class ManOperationalInterest extends Controller
{
    public function create($lang, Man $man): View
    {
        Session::put('route', 'operational-interest.create');
        Session::put('model', $man);

        $manTeg = Session::get('modelId');
        if ($manTeg) {
            $manTeg = Man::find($manTeg);
        }

        return view('operation-interest.index', compact('man', 'manTeg'));
    }

    public function store($lang, Man $man,OperationalInterestCreateRequest $request){
     dd($man,$request);
    }
}
