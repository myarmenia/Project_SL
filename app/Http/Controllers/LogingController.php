<?php

namespace App\Http\Controllers;

use App\Models\Log\Log;
use App\Models\User;
use Illuminate\Http\Request;

class LogingController extends Controller
{
    public function index(Request $request)
    {

        // $k1 = User::all();

        // dd($k1->logs1);

        $logs = Log::where('id', '>', 0);

        $data = $request->all();

        if (!empty($data)) {
            foreach ($data as $key => $item) {
                if ($item != null) {
                    if ($key == 'username' || $key == 'first_name' || $key == 'last_name') {
                        $user = User::where($key, 'like', "%$item%")->get();
                        $user_ids = $user->pluck('id');
                        $logs = $logs->whereIn('user_id', $user_ids);
                    } else if ($key == 'created_at') {
                        $logs = $logs->whereDate($key, $item);
                    } else {
                        $logs = $logs->where($key, $item);
                    }
                }
            }
        }

        $logs = $logs->orderBy('id', 'DESC')->paginate(10);

        return view('loging.index', compact('logs'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function getLogById($lang, $logId)
    {

        $log = Log::find($logId);
        $getLogsById = Log::where('tb_name', $log->tb_name)->where('tb_id', $log->tb_id)->get();

        return view('loging.restore', compact('getLogsById', 'logId'));
    }
}
