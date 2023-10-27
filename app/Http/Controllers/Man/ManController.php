<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManFieldsUpdateRequest;
use App\Models\Man\Man;
use App\Services\ManService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ManController extends Controller
{
    protected ManService $manService;

    public function __construct(ManService $manService)
    {
        $this->manService = $manService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        $newUserId = $this->store();

        return redirect()->route('man.edit', ['man' => $newUserId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return int
     */
    public function store(): int
    {
        return $this->manService->store();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $lang
     * @param  Man  $man
     * @return View
     */
    public function edit($lang, Man $man): View
    {
        $man->load('gender','nation','knows_languages');

        return view('man.index', compact('man'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $lang
     * @param  ManFieldsUpdateRequest  $request
     * @param  Man  $man
     * @return JsonResponse
     */
    public function update($lang, ManFieldsUpdateRequest $request, Man $man): JsonResponse
    {
        $updated_field = $this->manService->update($man, $request->validated());

        return response()->json(['result' => $updated_field]);
    }

    public function deleteFromTable($lang, Request $request): JsonResponse
    {
        $id = $request['id'];
        $pivot_table_name = $request['pivot_table_name'];
        $model_id = $request['model_id'];
        $find_model = Man::find($model_id);

        if ($request['pivot_table_name'] ==='file1'){
            Storage::disk('public')->delete($find_model->$pivot_table_name->first()->path);
        }
        if (isset($request['relation']) && $request['relation'] === 'has_many'){
            $find_model->$pivot_table_name->find($id)->delete();
        }else{
            $find_model->$pivot_table_name()->detach($id);
        }

        return response()->json(['result'=>'deleted'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
