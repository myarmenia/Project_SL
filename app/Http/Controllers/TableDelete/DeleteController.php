<?php

namespace App\Http\Controllers\TableDelete;

use App\Http\Controllers\Controller;
use App\Services\Delete\DictionaryDeleteService;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function destroy( $page,  $id, Request $request) {
       if($request->section_name == 'dictionary') {
            DictionaryDeleteService::destroy($page, $id);
       }
    }
}
