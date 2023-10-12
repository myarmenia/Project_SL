<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('translate.index', compact('data', 'page'));
    }

    public function create() {
        return view('translate.create');
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

        if ($data) {
            $translate_text = [];
            foreach ($data as $key => $el) {

                if ($el != null
                ) {
                    if ($key == 'family_name') {
                        $el = $el . 'i';
                    }
                    $translate_text[$key] = $el;

                }
            }

            $learning_info = LearningSystemService::get_info($translate_text);

        }

        return redirect()->back()->with('result', $learning_info);
    }

    public function system_learning(Request $request) {

        $data = $request->except('_token');

        $result = LearningSystemService::learning_system($data);

        return back();

    }
}
