<?php

namespace App\Services\Delete;

use Illuminate\Support\Facades\DB;

class DictionaryDeleteService
{

    public static function destroy($page, $id)
    {
        DB::table($page)->where('id', $id)->delete();
    }
}
