<?php

namespace App\Http\Controllers;

use App\Models\Bibliography\BibliographyHasFile;
use App\Models\File\File;
use App\Services\FileUploadService;
use App\Services\Form\FormContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public $formContentService;

    public function __construct(FormContentService $formContentService){

        $this->formContentService = $formContentService;
    }
    // public function index(Request $request,$lang,$table_name){

    //     $get_table_id=$this->formContentService->create($table_name);
    //     $data=$this->formContentService->find($table_name,$get_table_id);

    //     $blade_name=$table_name.'.index';
    //     return view($blade_name,compact('data','table_name'));

    // }
    public function get_section(Request $request){
        // dd($request->all());

        $table = DB::table($request->table_name)->get();
        $model_name = $request->table_name;


        return response()->json(['result'=>$table,'model_name'=>$model_name,]);
    }
    public function update(Request $request){
dd($request->all());
        $table_name = $request['table_name'];
        $table_id = $request['id'];
        $updated_feild = $request['fieldName'];
        $value=$request['value'];
            if($request['fieldName']=='file'){

                $folder_path='bibliography/'.$table_id;
                $fileName = time() . '_' . $value->getClientOriginalName();
                $path = $value->storeAs($folder_path, $fileName);
                $fullPath = storage_path('app/' . $path);

                $fileId =  FileUploadService::addFile($fileName, $value->getClientOriginalName(), $path);

                if($fileId){

                    $update = BibliographyHasFile::bindBibliographyFile($table_id, $fileId);
                }


            }else{
                $update = $this->formContentService->update($request['table_name'],$request['id'], $updated_feild,$value);

            }




        return response()->json(['message'=>$update]);

    }
    public function store(Request $request){


        $newrow=$this->formContentService->store($request->all());

        $table = DB::table($request['table_name'])->get();
        $model_name = $request['table_name'];

        return response()->json(['result'=>$table,'model_name'=>$model_name,]);

    }

}
