<?php

namespace App\Http\Controllers\TableDelete;

use App\Http\Controllers\Controller;
use App\Services\Delete\DictionaryDeleteService;
use App\Services\Relation\ModelRelationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function destroy($page,  $id, Request $request)
    {

        if ($request->section_name == 'dictionary') {

            // DictionaryDeleteService::destroy($page, $id);
            $data = ModelRelationService::model_relation($page, $id);

            dd(123);

            if (count($data) == 0) {
                DB::table($page)->where('id', $id)->delete();
                return response()->json(['result' => 'undefined']);
            } else {
                return response()->json(['result' => 'undefined']);
            }
        } else if ($request->section_name == 'open') {
            $model = ModelRelationService::get_model_class($page);

            $model::find($id)->delete();
        }
    }

    public function destroy_search($page,  $id)
    {
        $find_text = str_contains($page, 'result_');

        if ($find_text) {
            $page = str_replace('result_', '', $page);
        }

        if ($page == 'control') {
            $model_name = ucfirst('controll');

            $model = app('App\Models\\' . $model_name);
        } else {
            $model = ModelRelationService::get_model_class($page);
        }


        $model::find($id)->delete();
    }
}
