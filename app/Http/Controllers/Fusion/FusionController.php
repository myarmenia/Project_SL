<?php

namespace App\Http\Controllers\Fusion;

use App\Http\Controllers\Controller;
use App\Http\Requests\FusionCheckIdsRequest;
use Illuminate\Http\Request;

class FusionController extends Controller
{
    public function index(){
        return view('fusion.index');
    }

    public function fusion_start(){
        return view('fusion.edit');
    }

    public function fusion_check_ids($lang, FusionCheckIdsRequest $request){

        return view('fusion.index');

    }
}
