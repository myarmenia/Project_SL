<?php

namespace App\Services;

use App\Models\AccessLevel;
use App\Models\Agency;
use App\Models\Country;
use App\Models\DocCategory;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BibliographyFilterService
{
    public $search=[];
    public function filter(Request $request){
// dd($request->all());
        $model_name = $request->path;

        $query=DB::table($request->path)->where('name','like', $request->name. '%')->get();

        foreach($query as $key=>$item){

            $this->search[$item->id]=$item->name;

        }
        return response()->json(['result'=>$this->search, 'model_name'=>$model_name,'section_id'=>$request->path]);


    }
    public  static function store($request){


    }
}
