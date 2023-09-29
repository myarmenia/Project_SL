<?php

namespace App\Http\Controllers\TableDelete;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function destroy(
        $page,
        $id,
        Request $request
    ) {
        dd($request->all());
            if($request->section_name == 'dictionary') {
        }
    }
}
