<?php

namespace App\Services;


use App\Models\Man\Man;
use App\Services\Log\LogService;
use App\Events\ConsistentSearchRelationsEvent;
use App\Services\Relation\ModelRelationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ComponentService
{

    /**
     * @param  object  $mainModel
     * @param  array  $attributes
     * @param  string|null  $dir
     * @return mixed|null
     */
    public static function update(object $mainModel, array $attributes, string|null $dir = ''): mixed
    {

        if(isset($attributes['delete_relation']) && $attributes['delete_relation']){
            $attributes['value'] = null;
        }

        $newData = [$attributes['fieldName'] => $attributes['value']];

        $newModel = null;
        $table = $attributes['table'] ?? null;
        $model = $attributes['model'] ?? null;

        if ($attributes['type'] === 'create_relation') {
            $newModel = $mainModel->$model()->firstOrCreate([$attributes['fieldName'] =>$attributes['value']],[$attributes['fieldName']  => $attributes['value']]);

            $log = LogService::store($newData, $mainModel->id, $mainModel->getTable(), 'update');

            event(new ConsistentSearchRelationsEvent($newModel->getTable(), $newModel->id, $attributes['value'], $mainModel['id']));

        } elseif ($attributes['type'] === 'attach_relation') {
            $mainModel->$table()->attach($attributes['value']);
            $newModel = app('App\Models\\'.$model)::find($attributes['value']);

        } elseif ($attributes['type'] === 'update_field') {
            $mainModel->update($newData);

            if($mainModel->getTable()=='signal'){
                if($attributes['fieldName']=='check_date'|| $attributes['fieldName']=='end_date'){
                    $mainModel->count_number();
                }

            }


            $log = LogService::store($newData, $mainModel->id, $mainModel->getTable(), 'update');
            $newModel= $mainModel;
            event(new ConsistentSearchRelationsEvent($newModel->getTable(), $newModel->id, $attributes['value'], $mainModel['id']));
        } elseif ($attributes['type'] === 'file') {
            $newModel = json_decode(
                FileUploadService::saveFile($mainModel,$attributes['value'],$mainModel->getTable().'/'.$mainModel->id.$dir)
            );
        }

        return $newModel;
    }

    public function deleteFromTable(Request $request): JsonResponse|array
    {
        $segments = explode('/', parse_url(url()->previous())['path']);
        $id = $request['id'];
        $pivot_table_name = $request['pivot_table_name'];
        $model_id = $segments[3];
        $model_name = $segments[2];

        $find_model = ModelRelationService::get_model_class($model_name)->find($model_id);

        if ($request['pivot_table_name'] ==='file1'){
            Storage::disk('public')->delete($find_model->$pivot_table_name->first()->path);
        }
        if (isset($request['relation']) && $request['relation'] === 'has_many'){
            $find_model->$pivot_table_name->find($id)->delete();
        }elseif (isset($request['relation']) && $request['relation'] === 'update_field'){
            $find_model->$pivot_table_name()->delete();
        }
        else{
            $find_model->$pivot_table_name()->detach($id);
        }

        if (Session::get('returnNames')){
            session()->forget('returnNames');
            return [
                'model' => $find_model,
                'pivot_table_name' => $pivot_table_name,
                'model_name' => $model_name,
            ];
        }

        $this->setFullName($pivot_table_name,$model_id);

        return response()->json(['result'=>'deleted'],200);
    }

    public function setFullName($pivot_table_name,$modelId): void
    {
        if (in_array($pivot_table_name, ['last_name','first_name','middle_name'])){
            $man = Man::find($modelId);
            $man->full_name = $man->firstName1->pluck('first_name')->merge($man->lastName1->pluck('last_name'))->merge($man->middleName1->pluck('middle_name'))->filter()->implode(' ');
            $man->save();
        }
    }



    public function updateFile($request, $table_name, $table_id)
    {

        $find_table_row = DB::table($table_name)->where('id', $table_id)->update([
            'video' => 1
        ]);

    }

    public function get_section(Request $request)
    {
        // dd($request->all());

        $table = DB::table($request->table_name)->orderBy('id','desc')->get();
        $model_name = $request->table_name;


        return response()->json(['result' => $table, 'model_name' => $model_name,]);
    }
    public function storeTableField($lang, Request $request)
    {
// dd($request->table_name);
         DB::table($request->table_name)->updateOrInsert([
            $request['fieldName'] =>$request['value']
        ]);

        $table = DB::table($request['table_name'])->orderBy('id','desc')->get();
        $model_name = $request['table_name'];

        return response()->json(['result' => $table, 'model_name' => $model_name,]);
    }


    public $search = [];
    public function filter(Request $request)
    {

        $model_name = $request->path;


        $query = DB::table($request->path)->where('name', 'like', '%'.$request->name .'%')->orderBy('id','desc')->get();

        $validate=[];
        if (count( $query) === 0) {

            $validate['result_search_dont_matched']='required';
            $validator = Validator::make($request->all(),$validate);

            if($validator->fails()){

                return response()->json(['errors' => $validator->errors()], 400);

            }



        } else {

            return response()->json(['result' => $query, 'model_name' => $model_name, 'section_id' => $request->path]);
        }
    }


    // ===========


}
