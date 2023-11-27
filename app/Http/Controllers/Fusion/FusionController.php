<?php

namespace App\Http\Controllers\Fusion;

use App\Http\Controllers\Controller;
use App\Http\Requests\FusionCheckIdsRequest;
use App\Models\Car;
use App\Models\Man\Man;
use App\Models\Weapon;
use App\Services\Filter\ResponseResultService;
use App\Services\Relation\ModelRelationService;
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

        // $first_item = DB::table($request->name)->where('id', $request->first_id)->get()->toArray();
        // $second_item = DB::table($request->name)->where('id', $request->second_id)->get()->toArray();
        $model = ModelRelationService::get_model_class($request->name);
        $first_i = Man::where('id', $request->first_id)->first();
        $second_i = $model->find($request->second_id);

    // $result = $model::with($model->relation)->get()->toArray();
        $first_item = $model->where('id', $request->first_id)->with($model->modelRelations)->first()->toArray();
        $second_item = $model->where('id', $request->second_id)->with($model->modelRelations)->first()->toArray();
        // $second_item = $model->where('id', $request->second_id)->with($model->modelRelations)->with($model->relation)->first()->toArray();

        $data = array_merge_recursive($first_item, $second_item);
        // $data = array_filter($data, fn($value) => !is_null($value[0]) && !is_null($value[1]));

        // dd($model->relation);

        // $data = array_filter($data, function($v, $k) {
        //     return (isset($v[0]) && $v[0] !== null) || (isset($v[1]) && $v[1] !== null);
        // }, ARRAY_FILTER_USE_BOTH);

        // dd($data);
        foreach ($data as $key => $value) {


            $rel = explode('_id', $key);
            if( count($rel) > 0 && in_array($rel[0], $model->relationFields) ){
                $arr['id'] = $value[0];
                $arr['name'] = $value[0];
                $k = $first_i->{$rel[0]};
                dd($k);
                dump($first_i->{$rel[0]}->array_values($k)[2]);

                $value[0] = $arr;

                // array_push($value, $arr);

                // $value[0]['id']= 5555;u

                dd($value);
                // $value[0]["name"] = $value[0] != null ? $model->$rel[0]->name : null;
                // $value[1]["id"] = $value[0] ?? null;
                // $value[1]["name"] = $value[1] != null ? $model->$rel[0]->name : null;

            }
        }

        dump($data);



        // return view('fusion.result', compact('data'));

    }
}
