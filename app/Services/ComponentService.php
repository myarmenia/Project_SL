<?php

namespace App\Services;

use App\Models\Bibliography\BibliographyHasFile;
use App\Services\Relation\ModelRelationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ComponentService
{

    /**
     * @param  object  $mainModel
     * @param  array  $attributes
     * @param  string|null  $dir
     * @param  string|null  $dir2
     * @return mixed|null
     */
    public static function update(object $mainModel, array $attributes, string|null $dir = '', string|null $dir2 = ''): mixed
    {
        $newData = [$attributes['fieldName'] => $attributes['value']];
        $newModel = null;
        $table = $attributes['table'] ?? null;
        $model = $attributes['model'] ?? null;

        if ($attributes['type'] === 'create_relation') {
            $newModel = $mainModel->$model()->create($newData);
        } elseif ($attributes['type'] === 'attach_relation') {
            $mainModel->$table()->attach($attributes['value']);
            $newModel = app('App\Models\\'.$model)::find($attributes['value']);
        } elseif ($attributes['type'] === 'update_field') {
            $mainModel->update($newData);
        } elseif ($attributes['type'] === 'file') {
            $newModel = json_decode(
                FileUploadService::saveFile($mainModel, $attributes['value'], $dir.$mainModel->id.$dir2)
            );
        }

        return $newModel;
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


    public function deleteFromTable(Request $request)
    {
        // dd($request->all());
        $id = $request['id'];
        $pivot_table_name = $request['pivot_table_name'];
        $model_id = $request['model_id'];
        $model_name = $request['model_name'];

        $find_model = ModelRelationService::get_model_class($model_name)->find($model_id);
        // $find_model = Man::find($model_id);

        if ($request['pivot_table_name'] ==='file1'){
            Storage::disk('public')->delete($find_model->$pivot_table_name->first()->path);
        }
        if (isset($request['relation']) && $request['relation'] === 'has_many'){
            $find_model->$pivot_table_name->find($id)->delete();
        }else{
            $find_model->$pivot_table_name()->detach($id);
        }

        return response()->json(['result'=>'deleted'],200);
    }
}
