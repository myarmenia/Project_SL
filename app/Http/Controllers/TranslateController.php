<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\LearningSystem;
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

        $data = $request->except('_token');
        $content = $data['content'];

        $learning_info = LearningSystemService::get_info($content);

        return response()->json($learning_info, 200);

        // return redirect()->back()->with('result', $learning_info);
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

        $validate = [
            'armenian' => 'required|unique:learning_systems',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            // return back()->withErrors($validator)->withInput();
            return response()->json($validator, 200);
        }

        $new_learning_system = LearningSystem::create($request->all());

        if($new_learning_system) {
            return response()->json([
                'status' => 'success',
                'id' => $new_learning_system->id
            ], 200);
        }
    }
}
