<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldsCreateRequest;
use App\Models\Action;
use App\Services\ActionService;
use App\Services\OrganizationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    protected ActionService $actionService;

    public function __construct(ActionService $actionService)
    {
        $this->actionService = $actionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create()
    {
        $newAction = $this->store();

        return redirect()->route('action.edit', ['action' => $newAction]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(): int
    {
        return $this->actionService->store();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $lang
     * @param  Action  $action
     * @return Application|Factory|View
     */
    public function edit($lang, Action $action)
    {
        return view('action.edit', compact('action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $lang
     * @param  Action  $action
     * @param  FieldsCreateRequest  $request
     * @return JsonResponse
     */
    public function update($lang, Action $action, FieldsCreateRequest $request)
    {
        $updated_field = $this->actionService->update($action, $request->validated());

        return response()->json(['result' => $updated_field]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
