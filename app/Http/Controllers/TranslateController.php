<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\LearningSystem;
use App\Services\LearningSystemService;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class TranslateController extends Controller
{

    public function index()
    {
        $page = 'learning_systems';
        $data = LearningSystem::orderBy('id', 'desc')->paginate(20);
        $chapters = Chapter::orderby('id', 'desc')->get();
        return view('translate.index', compact('data', 'chapters', 'page'));
    }

    public function create()
    {
        $chapters = Chapter::orderby('id', 'desc')->get();

        return view('translate.create', compact('chapters'));
    }

    // public function translate(Request $request)
    // {

    //     $data = $request->except('_token');

    //     if ($data) {
    //         $translate_text = '';
    //         foreach ($data as $key => $el) {

    //             if ($el != null) {
    //                 if ($key == 'family_name') {
    //                     $el = $el . 'i';
    //                 }
    //                 $translate_text .= $el . ($key != 'family_name' ?  ' ' : '');
    //             }
    //         }

    //         $result = TranslateService::translate($translate_text);
    //     }

    //     return redirect()->route('translate.index')->with('result', $result);

    // }

    public function translate(Request $request)
    {

        $data = $request->except('_token');
        $content = $data['content'];

        $learning_info = LearningSystemService::get_info($content);


        return redirect()->back()->with('result', $learning_info);
    }

    // public function system_learning(Request $request) {


    //     $data = $request->except('_token');

    //     $result = LearningSystemService::learning_system($data);

    //     return back();

    // }
}
