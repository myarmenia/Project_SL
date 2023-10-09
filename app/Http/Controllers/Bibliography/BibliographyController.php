<?php

namespace App\Http\Controllers\Bibliography;

use App\Http\Controllers\Controller;
use App\Models\AccessLevel;
use App\Models\Agency;
use App\Models\Bibliography\Bibliography;
use App\Models\Country;
use App\Models\DocCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BibliographyController extends Controller
{
    public function create() {

        $getbibliography = Bibliography::getBibliography();
        // $agency = Agency::all();
        return view('bibliography.index', compact('getbibliography'));
    }
    public function get_section(Request $request){
        // dd($request->all());
        $table = DB::table($request->table_name)->get();
        $model_name = $request->table_name;


        return response()->json(['result'=>$table,'model_name'=>$model_name,]);
    }
    public function update(Request $request,$lang, $id){
        // dd($request->all());


        $store_bibliograph = Bibliography::updateBibliography($request->all(),$id);


        return response()->json(['message'=>$store_bibliograph]);
    }
}
