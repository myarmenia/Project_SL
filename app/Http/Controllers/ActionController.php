<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionCreateRequest;
use App\Http\Requests\FieldsCreateRequest;
use App\Models\Action;
use App\Models\Bibliography\Bibliography;
use App\Services\ActionService;
use App\Services\OrganizationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
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
    public function create($land, Bibliography $bibliography)
    {
        $newAction = $this->store($bibliography);

        return redirect()->route('action.edit', ['action' => $newAction]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Bibliography  $bibliography
     * @return Action
     */
    public function store(Bibliography $bibliography)
    {
        return $this->actionService->store($bibliography->id);
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
     * @param  ActionCreateRequest  $request
     * @return JsonResponse
     */
    public function update($lang, Action $action, ActionCreateRequest $request)
    {
        $updated_field = $this->actionService->update($action, $request->validated());

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
