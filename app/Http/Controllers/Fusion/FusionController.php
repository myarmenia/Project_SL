<?php

namespace App\Http\Controllers\Fusion;

use App\Http\Controllers\Controller;
use App\Http\Requests\FusionCheckIdsRequest;
use App\Models\Car;
use App\Models\Man\Man;
use App\Models\Weapon;
use App\Services\Filter\ResponseResultService;
use App\Services\Fusion\FusionService;
use App\Services\Log\LogService;
use App\Services\Relation\ModelRelationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FusionController extends Controller
{
    public function index()
    {
        return view('fusion.index');
    }

    public function fusion_start()
    {
        return view('fusion.edit');
    }

    public function fusion_check_ids($lang, FusionCheckIdsRequest $request)
    {

        $result = FusionService::items($request);

        $data = $result['data'];
        $uniqueFields = $result['uniqueFields'];
        $table_name = $result['table_name'];
        $first_id = $result['first_id'];
        $second_id = $result['second_id'];

        return view('fusion.result', compact('data', 'uniqueFields', 'table_name', 'first_id', 'second_id'));

    }


    public function fusion($lang, Request $request, $table_name, $first_id, $second_id)
    {
        // dd($request->all());
        $ids = ['first_id' => $first_id,'second_id' => $second_id];
        $data = FusionService::fusion($request, $table_name, $first_id, $second_id);
        $result = $data === true ? __('messages.fusion_successfully') : __("messages.error");
         LogService::store($ids, null , $table_name,'fusion');
        return redirect()->route('fusion.name', $table_name)->with('result', $result);
    }


    public function fusion_more_ids($lang, Request $request)
    {
        // dd($request->all());
        $arr_ids = $request->all_fusion_id;
        $data = FusionService::fusion_more_ids($request);

        $result = $data === true ? __('messages.fusion_successfully') : ($data == 'data_discrepancy_exists' ? __("messages.data_discrepancy_exists") : __("messages.error"));
        LogService::store($arr_ids, null , $request->tb_name,'fusion');
        return response()->json(['result' => $result]);
    }


}
