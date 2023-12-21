<?php

namespace App\Http\Controllers;

use App\Models\MoreData;

class MoreDataController extends Controller
{
    public function __invoke($lang, MoreData $moreData)
    {
        return response()->json(['result' => $moreData->text]);
    }
}
