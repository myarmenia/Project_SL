<?php

namespace App\Http\Controllers\Controll;

use App\Http\Controllers\Controller;
// use App\Models\Control;
use App\Models\Controll;
use App\Services\ComponentService;
use App\Services\ControllService;
use Illuminate\Http\Request;


class ControllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $componentService;
    protected $controllService;
    public function __construct(

        ComponentService $componentService,
        ControllService $controllService,

    ){

        $this->controllService = $controllService;

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang,Request $request)
    {
        $controllId = $this->store($request->bibliography_id);
        return redirect()->route('controll.edit',  $controllId);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($bibliography_id): int
    {
        return $this->controllService->store($bibliography_id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Controll $controll)
    {
        return view('controll.edit',compact('controll'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($lang, Request $request, Controll $controll)
    {
        $updated_field = $this->controllService->update($controll, $request->all());

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
