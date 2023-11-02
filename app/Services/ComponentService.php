<?php

namespace App\Services;

use App\Models\Bibliography\BibliographyHasCountry;
use App\Models\Bibliography\BibliographyHasFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ComponentService
{

    public function update($request,  $table_name, $table_id)
    {
        // dd($request->all());
        $updated_feild = $request['fieldName'];

        // $value = $request['value'];
        $value = '';

        if($request->has('delete_relation')){
            if($request->delete_relation==true){
                $value = null;
            }

        }else{
            $value = $request['value'];

        }

        $table=DB::table($table_name)->where('id', $table_id)->update([
            $updated_feild=>$value
        ]);

        if($updated_feild == 'country_id'){
           $bind_country = BibliographyHasCountry::bindBibliographyCountry($table_id,$value);
           if($bind_country){

                $table = DB::table('country')->where('id',$value)->first();

                return $table;

           }

        }

        $table=DB::table($table_name)->where('id',$table_id)->first();

        return  $table;
    }

    public function updateFile($request, $table_name, $table_id)
    {

        $updated_feild = $request['fieldName'];
        $value = $request['value'];

        if ($request['fieldName'] == 'file') {

            $folder_path = $table_name . '/' . $table_id;
            $fileName = time() . '_' . $value->getClientOriginalName();

            $path = FileUploadService::upload($value, $folder_path);
            $file_content=[];
            $file_content['name']=$fileName;
            $file_content['real_name']=$value->getClientOriginalName();
            $file_content['path'] = $path;

            $file = DB::table('file')->insertGetId($file_content);

            if($file) {

                BibliographyHasFile::bindBibliographyFile($table_id, $file);

                $getMimeType=$value->getClientMimeType();
               if($getMimeType == 'video/mp4' || $getMimeType =='video/mov'){

                    $find_table_row = DB::table($table_name)->where('id', $table_id)->update([
                        'video' => 1
                    ]);

               }
            }


        }
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
}
