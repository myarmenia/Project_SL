<?php

namespace App\Http\Controllers\SearchInclude;

use App\Http\Controllers\Controller;
use App\Models\ConsistentFollower;
use App\Models\ConsistentLibrary;
use App\Models\ConsistentSearch;
use App\Models\Library;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConsistentSearchController extends Controller
{

    /**
     * @param $lang
     * @param int $first_page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function consistentSearch($lang, $first_page = 1)
    {
        try {
            $users = User::query()->where('id', '!=', Auth::id())->get();
            $libraries = Library::query()->get();
            $consistentSearch = ConsistentSearch::query()
                ->with(['consistentLibraries.library', 'consistentFollowers.user', ])
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();

            return view('consistent-search.index', compact('first_page', 'users', 'libraries', 'consistentSearch'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    /**
     * @param $lang
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function consistentStore($lang, Request $request)
    {
        $validate = [
            'search_text' => 'required|max:255',
            'deadline' => 'nullable|after:yesterday',
        ];


        $validator = Validator::make($request->all(), $validate);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $consistentSearch = ConsistentSearch::query()->create([
                'user_id' => Auth::id(),
                'search_text' => $request->search_text,
                'deadline' => $request->deadline,
            ]);


            if($request->following) {
                foreach ($request->following as $item) {
                    ConsistentFollower::query()->create([
                        'consistent_search_id' => $consistentSearch->id,
                        'user_id' => $item
                    ]);
                }
            }


            if($request->library) {
                foreach ($request->library as $item) {
                    ConsistentLibrary::query()->create([
                        'consistent_search_id' => $consistentSearch->id,
                        'library_id' => $item
                    ]);
                }
            }


            return redirect()->back()->with('success', 'Consistent search created successfully');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function consistentDestroy(Request $request)
    {
        ConsistentSearch::query()->find($request->id)->delete();
        return redirect()->back()->with('success', 'Consistent search deleted successfully');
    }
}
