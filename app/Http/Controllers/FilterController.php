<?php

namespace App\Http\Controllers;

use App\Services\Filter\DictionaryFilterService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter($page, Request $request)
    {

        $request['page'] = $page;

        $input = $request->all();

        $table_name = $input[0]['table_name'];
        $section_name = $input[0]['section_name'];
        $result = '';

        if ($section_name == 'dictionary' || $section_name == 'translate') {
            $result = DictionaryFilterService::filter($input, $table_name, $page);
        } else if ($section_name == 'open') {

            $find_text = str_contains($table_name, '_');

            if ($find_text && $table_name != 'work_activity') {
                $model_name = str_replace('_', '', ucwords($table_name, '_'));
            } else {
                $model_name = $table_name;
            }

            if ($table_name == 'man' || $table_name == 'bibliography') {
                $model_name =  ucfirst($model_name) . '\\' . ucfirst($model_name);
            } else if ($table_name == 'work_activity') {
                $model_name = ucfirst('OrganizationHasMan');
            } else if ($table_name == 'sign') {
                $model_name = ucfirst('ManExternalSignHasSign');
            } else {
                $model_name =  ucfirst($model_name);
            }

            $model = app('App\Models\\' . $model_name);

            $result = app($model)
                ->filter($request->all())
                ->get();

            dd($result);
        } else {
        }

        return response()->json($result);
    }
}
