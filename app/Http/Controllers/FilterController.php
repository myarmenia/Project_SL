<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Services\Filter\DictionaryFilterService;
use App\Services\Filter\ResponseResultService;
use App\Services\Relation\ModelRelationService;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter($page, Request $request)
    {
        $request['page'] = $page;

        $input = $request->filter;
        $search = $request->search;

        $ids = null;

        if ($search != null) {
            $ids = getSearchMan($search);
        }

        $table_name = $input[0]['table_name'];
        $section_name = $input[0]['section_name'];
        $result = '';
        $final_look_arr = [];

        if ($section_name == 'dictionary' || $section_name == 'translate') {

            $result = DictionaryFilterService::filter($input, $table_name, $page);

            return response()->json($result);
        } else if ($section_name == 'open') {

            $finish_data = [];

            if (
                $table_name == 'sign'
            ) {
                $model_name = ucfirst('ManExternalSignHasSign');
                $model = app('App\Models\\' . $model_name);
            } else {
                $model = ModelRelationService::get_model_class($table_name);
            }


            if ($ids != null) {
                $result = $model
                    ->filter($request->filter)
                    ->whereIn('id', $ids)
                    ->with($model->relation)
                    ->orderBy('id', 'desc')
                    ->paginate(20)
                    ->toArray();

                $result_count = $model
                    ->filter($request->filter)
                    ->whereIn('id', $ids)
                    ->with($model->relation)
                    ->orderBy('id', 'desc')
                    ->get()
                    ->count();
            } else {
                $result = $model
                    ->filter($request->filter)
                    ->with($model->relation)
                    ->orderBy('id', 'desc')
                    ->paginate(20)
                    ->toArray();

                $result_count = $model
                    ->filter($request->filter)
                    ->with($model->relation)
                    ->orderBy('id', 'desc')
                    ->get()
                    ->count();
            }



            $finish_data = ResponseResultService::get_result($result, $model, 'filter');

            // dd($finish_data);

            $finish_data['result_count'] = $result_count;
            $finish_data['current_page'] = $result['current_page'];
            $finish_data['last_page'] = $result['last_page'];

            return response()->json($finish_data);
        }
    }
}
