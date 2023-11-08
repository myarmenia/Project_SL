<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManFieldsUpdateRequest;
use App\Models\Man\Man;
use App\Services\ManService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

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
     * @param $lang
     * @param  Man  $man
     * @return JsonResponse
     */
    public function fullName($lang, Man $man): JsonResponse
    {
        return response()->json(['result' => $man->fullName]);
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
        session()->forget('main_route');
        session()->forget('modelId');
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
        dd($man);
        // dd($request->validated());
        $updated_field = $this->manService->update($man, $request->validated());

        return response()->json(['result' => $updated_field]);
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
