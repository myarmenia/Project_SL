<?php

namespace App\Services\Form;

use App\Models\Bibliography\Bibliography;
use App\Models\Bibliography\BibliographyHasCountry;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormContentService
{
    public function create($table_name){
        // dd(Auth::id());
        $table=DB::table($table_name)->insertGetId([
            'user_id' =>Auth::id()
        ]);


        return $table;


    }
    public function find($table_name ,$get_table_id){

        $table=DB::table($table_name)->where('id',$get_table_id)->first();

        return $table;

    }
    public $search=[];
    public function filter(Request $request){
    

        $model_name = $request->path;

        $query=DB::table($request->path)->where('name','like', $request->name.'%')->get();

        foreach($query as $key=>$item){

            $this->search[$item->id]=$item->name;

        }

        if(count( $this->search)==0){

            return response()->json(['result'=>''],400);

        }else{
            return response()->json(['result'=>$this->search, 'model_name'=>$model_name,'section_id'=>$request->path]);

        }

    }

    public function update($table_name,$table_id,$updated_feild,$value){

        $table=DB::table($table_name)->where('id',$table_id)->update([
            $updated_feild=>$value
        ]);

        if($updated_feild=='country_id'){

            BibliographyHasCountry::bindBibliographyCountry($table_id,$value);
        }

        $table=DB::table($table_name)->where('id',$table_id)->first();

        return  $table;


    }
    public function store(array $request):bool{

        $table = DB::table($request['table_name'])->insert([
            $request['fieldName'] =>$request['value']
        ]);
        return $table;



    }
    public function delete(Request $request ){
        // $id, $pivot_table_name, $model_name, $model_id
        $id=$request['id'];
        $pivot_table_name=$request['pivot_table_name'];
        $model_name=$request['model_name'];
        $model_id=$request['model_id'];

        // dd($request['pivot_table_name']);
        $bibliography = Bibliography::find($model_id);


        $bibliography->country()->detach($request['id']);
        if(count($bibliography->country)>=1){

            if( $bibliography -> country_id == $request['id']){

                foreach ($bibliography->country as $key => $value) {

                    $bibliography -> country_id = $value->pivot->country_id;
                    $bibliography -> save();
                }
            }
        }else{

            $bibliography -> country_id = Null;
            $bibliography -> save();

        }


        return response()->json(['result'=>'deleted']);



    }





}

