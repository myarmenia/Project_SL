<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Services\Relation\ModelRelationService;
use Illuminate\Http\Request;

class ModelRelationController extends Controller
{
    public function get_relations(Request $request)
    {
        $data = ModelRelationService::model_relation($request->table_name, $request->table_id);

        return response()->json(['data' => $data]);
    }

    public function get_single_relation(Request $request)
    {
        $data = ModelRelationService::model_single_relation($request->table_name, $request->table_id);

        return response()->json(['data' => $data]);
    }
}
