<?php

namespace App\Services\Log;

use App\Models\Log\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogService
{
    public static function store(array|null $data, $tb_id, $tb_name, $type){

        $tb_id = $tb_id != null ? $tb_id : 0;
        $user = Auth::user();

        // $roles = $user->roles->count() > 0 ? implode(', ', $user->roles->pluck('name')->toArray()) : $user->name;

        $data = $data ? json_encode($data, JSON_UNESCAPED_UNICODE) : null;

        $log = Log::create([
            'user_id' => $user->id,
            'type' => $type,
            'tb_name' => $tb_name,
            'tb_id' => $tb_id,
            'data' => $data

        ]);

        return $log ? true : false;

    }
}
