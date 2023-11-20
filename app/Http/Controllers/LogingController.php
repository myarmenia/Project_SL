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

    public function getLogById($lang,$logId){

       $log = Log::find($logId);
       $getLogsById = Log::where('tb_name',$log->tb_name)->where('tb_id',$log->tb_id)->get();

            return view('loging.restore',compact('getLogsById'));
    }

    public function getLogDataById($lang,$logId)
    {
        $data = Log::select('data')->where('id',$logId)->first();

      $dataArray = json_decode($data->data, true);
dd($dataArray);
        return response()->json($dataArray);
    }
}
