<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\LearningSystem;
use App\Models\SystemLearningOption;
use App\Services\LearningSystemService;
use App\Services\TranslateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TranslateController extends Controller
{

    public function index()
    {
        $page = 'learning_systems';
        $data = LearningSystem::orderBy('id', 'desc')->paginate(20);
        $chapters = Chapter::orderby('id', 'desc')->get();
        return view('translate.index', compact('data', 'chapters', 'page'));
    }

    public function create()
    {
        $chapters = Chapter::orderby('id', 'desc')->get();

        return view('translate.create', compact('chapters'));
    }

    public function translate(Request $request)
    {

        // $validate = [
        //     'content' => 'required|regex:\^[ա-ֆԱ-Ֆև -]|[A-Za-z -]|[А-Яа-я -]+$/u'
        // ];

        // $validator = Validator::make($request->all(), $validate);

        // if ($validator->fails()) {
        //     return response()->json($validator, 200);
        // }


        $data = $request->except('_token');
        $content = $data['content'];

        $learning_info = LearningSystemService::get_info($content);

        return response()->json($learning_info, 200);
    }

    public function filter(Request $request)
    {
        $learning_system = LearningSystem::with('chapter');

        if ($request->id != null) {
            $learning_system = $learning_system->where('chapter_id', $request->id);
        }
        $learning_system = $learning_system->orderBy('id', 'desc')->paginate(20);
        return response()->json($learning_system, 200);
    }

    public function system_learning(Request $request)
    {

        $type = $request->type;
        unset($request['type']);
        $id = '';

        if ($type == 'parent') {
            $new_learning_system = LearningSystem::create($request->all());
            $id = $new_learning_system->id;
        } else {
            $new_learning_system_option = SystemLearningOption::create($request->all());
            $id = $new_learning_system_option->id;
        }

        return response()->json([
            'status' => 'success',
            'id' => $id
        ], 200);
    }

    public function system_learning_get_option(Request $request)
    {
        $learning_system_option = SystemLearningOption::where('system_learning_id', $request->system_learning_id)->get();

        return response()->json($learning_system_option, 200);
    }
}
