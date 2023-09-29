<?php

namespace App\Http\Controllers\Dictionay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DictionaryController extends Controller
{
    public function index($lang, $page)
    {
        $data = DB::table($page)->get();

        return view('dictionary.index', compact('data', 'page'));
    }

    public function store($lang, $page, Request $request)
    {
        $input = $request->except('_token');
        $validate = [
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $new_data = DB::table($page)->insert($input);

        return redirect()->back();
    }

    public function update(
        $lang,
        $page,
        $id,
        Request $request
    ) {

        $input = $request->all();

        $new_data = DB::table($page)->where('id', $id)->update($input);


        return response()->json($new_data, 200);
    }

    // public function destroy(
    //     $lang,
    //     $page,
    //     $id,
    //     Request $request
    // ) {


    // }
}
