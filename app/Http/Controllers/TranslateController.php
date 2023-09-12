<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TranslateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Text_LanguageDetect;
use PhpOffice\PhpWord\IOFactory;

class TranslateController extends Controller
{

    public function index()
    {
        return view('translate');
    }

    public function translate(Request $request)
    {

        $data = $request->except('_token');

        if ($data) {
            $translate_text = '';
            foreach ($data as $key => $el) {

                if ($el != null) {
                    if ($key == 'family_name') {
                        $el = $el . 'i';
                    }
                    $translate_text .= $el . ($key != 'family_name' ?  ' ' : '');
                }
            }

            $result = TranslateService::translate($translate_text);
        }

        return redirect()->route('translate.index')->with('result', $result);

    }
}
