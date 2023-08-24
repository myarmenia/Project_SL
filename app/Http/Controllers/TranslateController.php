<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;


class TranslateController extends Controller
{
    public function translate()
    {
        $lang = new GoogleTranslate();
        return $lang->setSource('hy')->setTarget('en')->translate("Нарине Айрапетян Робертовна");
    }
}
