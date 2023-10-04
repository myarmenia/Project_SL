<?php

namespace App\Http\Controllers;

use App\Services\Form\FormContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public $formContentService;

    public function __construct(FormContentService $formContentService){

        $this->formContentService = $formContentService;
    }
    public function index(Request $request){

        $get_table_id=$this->formContentService->create($request['table_name']);
        $getbibliography=$this->formContentService->find($request['table_name'],$get_table_id);
        $table_name=$request['table_name'];

        return view('bibliography.index',compact('getbibliography','table_name'));

    }
    public function get_section(Request $request){
        // dd($request->all());
        $table = DB::table($request->table_name)->get();
        $model_name = $request->table_name;


        return response()->json(['result'=>$table,'model_name'=>$model_name,]);
    }
    public function update(Request $request){

        // dd($request->all());
        $table_name = $request['table_name'];
        $table_id = $request['id'];
        $updated_feild = $request['fieldName'];
        $value=$request['value'];

        $update = $this->formContentService->update($request['table_name'],$request['id'], $updated_feild,$value);


        return response()->json(['message'=>$update]);

    }

}
