<?php

namespace App\Http\Controllers\Bibliography;

use App\Http\Controllers\Controller;
use App\Models\AccessLevel;
use App\Models\Agency;
use App\Models\Bibliography\Bibliography;
use App\Models\DocCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BibliographyController extends Controller
{
    public function create() {

        $getbibliography = Bibliography::getBibliography();
        // $agency = Agency::all();
        return view('bibliography.index', compact('getbibliography'));
    }
    public function get_section(Request $request){
        $section_property='';

        if($request->section_id==1){
            $section_property = Agency::all();

        }
        if($request->section_id==2){
            $section_property=DocCategory::all();
        }
        if($request->section_id==3){
            $section_property=AccessLevel::all();
        }

        return response()->json(['result'=>$section_property]);
    }
    public function filter(Request $request){
        dd(44);

    }
}
