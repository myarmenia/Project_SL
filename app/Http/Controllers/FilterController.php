<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
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
            if ($search['full_name'] != null) {
                $words = explode(' ', $search['full_name']);

                $k1 = Man::where('id', '>', 0);

                foreach ($words as $word) {
                    $k1 = $k1->where('full_name', 'like', "%$word%");
                }

                $ids = $k1->get()->pluck('id');
            } else if ($search['id'] != null) {
                $id = $search['id'];
                $ids = Man::where('id', $id)->get()->pluck('id');
            } else {
                $ids = getSearchMan($search);
            }
        }

        $table_name = $input[0]['table_name'];
        $section_name = $input[0]['section_name'];
        $result = '';

        // if ($request['bibliography_id'] != null) {
        //     $ids =  Bibliography::find($request['bibliography_id'])->$table_name->pluck_id;
        // }

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

            $finish_data['result_count'] = $result_count;
            $finish_data['current_page'] = $result['current_page'];
            $finish_data['last_page'] = $result['last_page'];

            return response()->json($finish_data);
        }
    }
}
