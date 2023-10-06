<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManFieldsUpdateRequest;
use App\Models\Man\Man;
use App\Services\BlurInputService;
use App\Services\ManService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
     * Show the form for editing the specified resource.
     *
     * @param $lang
     * @param  Man  $man
     * @return View|Factory|Application
     */
    public function edit($lang, Man $man): View|Factory|Application
    {
        $manId = $man->id;

        return view('man.index', compact('manId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $lang
     * @param  ManFieldsUpdateRequest  $request
     * @param  Man  $man
     * @return RedirectResponse
     */
    public function update($lang, ManFieldsUpdateRequest $request, Man $man): RedirectResponse
    {
        BlurInputService::store($man, $request->validated());

        return redirect()->route('man.edit', ['man' => $man->id]);
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
