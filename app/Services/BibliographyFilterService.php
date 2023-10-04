<?php

namespace App\Services;

use App\Models\AccessLevel;
use App\Models\Agency;
use App\Models\DocCategory;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BibliographyFilterService
{
    public $search=[];
    public function filter(Request $request){


        $array_filter=[];
        $query = '';
        if($request->path==1){

            $query=Agency::where('name','like', $request->name. '%')->get();

        }
        if($request->path==2){

            $query=DocCategory::where('name','like', $request->name. '%')->get();

        }
        if($request->path==3){
            
            $query=AccessLevel::where('name','like', $request->name. '%')->get();
        }

        foreach($query as $key=>$item){

            $this->search[$item->id]=$item->name;

        }
        return response()->json(['result'=>$this->search]);


    }
    public function push_filter_rezult(){

    }
}
