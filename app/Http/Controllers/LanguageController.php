<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    public function changeLanguage(Request $request, $locale)
    {
        if (! in_array($locale, ['ru', 'am'])) {
            abort(400);
        }
        
        App::setLocale($locale);

        return redirect()->back();
    }

}