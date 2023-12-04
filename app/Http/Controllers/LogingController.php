<?php

namespace App\Http\Controllers;

use App\Models\Log\Log;
use App\Models\User;
use Illuminate\Http\Request;

class LogingController extends Controller
{
    public function index(Request $request)
    {
        $logs = Log::where('id', '>', 0);

        $data = $request->except('page');

        if (!empty($data)) {
            foreach ($data as $key => $item) {
                if ($item != null) {
                    if ($key == 'username' || $key == 'first_name' || $key == 'last_name') {
                        $user = User::where($key, 'like', "%$item%")->get();
                        $user_ids = $user->pluck('id');
                        $logs = $logs->whereIn('user_id', $user_ids);
                    } else if ($key == 'date_from') {
                        $logs = $logs->whereDate('created_at', '>=', $item);
                    } else if ($key == 'date_to') {
                        $logs = $logs->whereDate('created_at', '<=', $item);
                    } else {
                        $logs = $logs->where($key, $item);
                    }
                }
            }
        }

        $logs = $logs->orderBy('id', 'DESC')->paginate(10)->withQueryString();

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
