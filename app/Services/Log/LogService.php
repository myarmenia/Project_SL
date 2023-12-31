<?php

namespace App\Services\Log;

use App\Models\Log\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogService
{
    public static function store(array|null $data, $tb_id, $tb_name, $type)
    {
        // dd($data,$tb_name,$type);
        // $tb_id = $tb_id != null ? $tb_id : null;
        $user = Auth::user();


        if ($user) {
            $user_id = $user->id;
        }
        else{
            $user_id = $tb_id;
        }
        // $roles = $user->roles->count() > 0 ? implode(', ', $user->roles->pluck('name')->toArray()) : $user->name;

        $data = $data ? json_encode($data, JSON_UNESCAPED_UNICODE) : null;
// dd($type);
        $log = Log::create([
            'user_id' => $user_id,
            'user_ip' => getHostByName(getHostName()),
            'type' => $type,
            'tb_name' => $tb_name,
            'tb_id' => $tb_id,
            'data' => $data

        ]);
// dd($log );
        return $log ? true : false;
    }
}
