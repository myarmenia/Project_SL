<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\LearningSystemService;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class TranslateController extends Controller
{

    public function index()
    {
        return view('translate');
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
            // $translate_text = '';
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

            if($learning_info != null) {
                return redirect()->route('translate.index')->with(['result' => $learning_info, 'type' => 'db']);
            }


            $result = TranslateService::translate($translate_text);
        }

        return redirect()->route('translate.index')->with('result', $result);
    }

    public function system_learning(Request $request) {

        $data = $request->except('_token');

        $result = LearningSystemService::learning_system($data);

    }
}
