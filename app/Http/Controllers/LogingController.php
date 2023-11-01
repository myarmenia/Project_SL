<?php

namespace App\Http\Controllers;

use App\Models\Log\Log;
use Illuminate\Http\Request;

class LogingController extends Controller
{
    public function index(Request $request){

        $logs = Log::orderBy('id', 'DESC')->paginate(15);

        return view('loging.index', compact('logs'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }
}
