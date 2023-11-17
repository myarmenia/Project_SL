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
            DB::table($page)->where('id', $id)->delete();
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

        $model = ModelRelationService::get_model_class($page);

        $model::find($id)->delete();
    }
}
