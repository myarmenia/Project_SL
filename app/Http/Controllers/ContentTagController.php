<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentTagRequest;
use App\Models\ContentTag;
use Illuminate\Http\Request;

class ContentTagController extends Controller
{
    public function index()
    {
        return view('test');
    }
    public function store(ContentTagRequest $request)
    {
       $create =  new ContentTag();
       $create->content = $request->content;
       $create->tag = $request->tag;
       $create->save();

        return response()->json(['messages' => 'success'], 200);
    }
}
