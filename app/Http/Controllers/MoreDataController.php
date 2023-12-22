<?php

namespace App\Http\Controllers;

use App\Models\Man\Man;
use App\Models\MoreData;
use Illuminate\Http\Request;

class MoreDataController extends Controller
{
    public function get($lang, Man $man, MoreData $moreData)
    {
        return response()->json(['result' => $moreData->text]);
    }

    public function update($lang, Man $man, MoreData $moreData, Request $request)
    {
        $moreData->update(['text'=> $request->value]);
    }
}
