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

        $validate = [
            'content' => 'required|regex:/[ա-ֆԱ-ՖևA-Za-zА-Яа-я\s-]+$/u',
            'chapter_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate);

        // ->first('content')

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => 'error'], 200);
        }

        $chapter = Chapter::find($request->chapter_id);


        if ($chapter != null) {
            $chapter_name = $chapter->content;
        }

        $data = $request->except('_token');
        $content = $data['content'];

        $learning_system_option = SystemLearningOption::where('name', $content)->first();

        if ($learning_system_option != null) {
            $learning_system = LearningSystem::find($learning_system_option->system_learning_id);

            $learning_info = [
                'id' => $learning_system->id,
                'armenian' => $learning_system->armenian,
                "russian" => $learning_system->russian,
                "english" => $learning_system->english,
                'type' => 'db'
            ];
        } else {
            $learning_info = LearningSystemService::get_info($content);
        }
        // return response()->json($learning_info, 200);


        return response()->json(['data' => $learning_info, 'chapter_name' => $chapter_name, 'status' => 'success'], 200);
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

        $data = $request->all();

        if ($type == 'parent') {

            $new_learning_system = LearningSystem::create($data);

            unset($data['chapter_id']);

            foreach ($data as $input) {
                SystemLearningOption::create([
                    'name' => $input,
                    'system_learning_id' => $new_learning_system->id,
                    'view_status' => 0
                ]);
            }

            $return_array = [
                'id' => $new_learning_system->id
            ];
        } else {
            $new_learning_system_option = SystemLearningOption::create($data);

            $return_array = [
                'id' => $new_learning_system_option->id,
                'name' => $new_learning_system_option->name
            ];
        }

        return response()->json(['data' => $return_array, 'status' => 'success', 'type' => $type], 200);
    }

    public function system_learning_get_option(Request $request)
    {
        $learning_system_option = SystemLearningOption::where('system_learning_id', $request->system_learning_id)->where('view_status', 1)->get();

        return response()->json(['data' => $learning_system_option, 'status' => 'success'], 200);
    }
}
