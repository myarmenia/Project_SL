<?php

namespace App\Services\Form;

use App\Models\Bibliography\BibliographyHasCountry;
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

        }
        return response()->json(['result'=>$this->search, 'model_name'=>$model_name,'section_id'=>$request->path]);

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





}

