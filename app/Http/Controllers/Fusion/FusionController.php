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
        $first_id = min($request->first_id,  $request->second_id);
        $second_id = max($request->first_id,  $request->second_id);

        $table_name = $request->name;
        // $first_item = DB::table($request->name)->where('id', $request->first_id)->get()->toArray();
        // $second_item = DB::table($request->name)->where('id', $request->second_id)->get()->toArray();
        $model = ModelRelationService::get_model_class($table_name);


        // $result = $model::with($model->relation)->get()->toArray();
        // $first_item = $model->where('id', $request->first_id)->with($model->modelRelations)->first()->toArray();
        // $second_item = $model->where('id', $request->second_id)->with($model->modelRelations)->first()->toArray();
        // $second_item = $model->where('id', $request->second_id)->with($model->modelRelations)->with($model->relation)->first()->toArray();
        $first_item = $model->where('id', $request->first_id)->first()->relation_field1();
        $second_item = $model->where('id', $request->second_id)->first()->relation_field1();
        $data = array_merge_recursive($first_item, $second_item);

        // $data = array_merge_recursive($first_item, $second_item, $first_item1, $second_item2);
        // $data = array_filter($data, fn($value) => !is_null($value[0]) && !is_null($value[1]));

        // dd($model->relation);

        $data = array_filter($data, function($v, $k) {
            return ( ((is_array($v[0]) && count($v[0]) > 0) || (is_array($v[1]) && count($v[1]) > 0)) ||
                    ((!is_array($v[0]) && !is_null($v[0])) || (!is_array($v[1]) && !is_null($v[1]))));
        }, ARRAY_FILTER_USE_BOTH);

        // dd($data);

        $uniqueFields = $model->uniqueFields;


        return view('fusion.result', compact('data', 'uniqueFields', 'table_name', 'first_id', 'second_id'));
    }


    public function fusion($lang, Request $request, $table_name, $id)
    {
        // dd($request->all());
        $model = ModelRelationService::get_model_class($table_name);
        $item =  $model->find($id);
        $data = $request->all();
        foreach ($data as $key => $value) {

            if (in_array($key, $model->uniqueFields)){
              $item->update([$key=>$value]);
            }

            // if ($key=='last_name'){
            //     dd($item->$key());
            //         $item->$key()->detach();
            //         $item->$key()->attach(array_keys($value));
            //   }
            else{

                dd( $item->$key()->pluck('id')->toArray() );
                dd( in_array($item->$key()->id, $value) );
                // if($item->$key()){
                    $item->$key()->detach();

                // }
                $item->$key()->attach($value);
            }
        }
    }
}
