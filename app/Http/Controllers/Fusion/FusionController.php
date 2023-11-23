<?php

namespace App\Http\Controllers\Fusion;

use App\Http\Controllers\Controller;
use App\Http\Requests\FusionCheckIdsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FusionController extends Controller
{
    public function index(){
        return view('fusion.index');
    }

    public function fusion_start(){
        return view('fusion.edit');
    }

    public function fusion_check_ids($lang, FusionCheckIdsRequest $request){

        $first_item = DB::table($request->name)->find($request->first_id);
        $second_item = DB::table($request->name)->find($request->second_id);


        return view('fusion.result', compact('first_item', 'second_item'));

    }
}
