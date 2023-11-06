<?php

namespace App\Http\Controllers\Signal;

use App\Http\Controllers\Controller;
use App\Services\ComponentService;
use App\Services\SignalService;
use Illuminate\Http\Request;

class SignalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $componentService;
    protected $signalService;
    public function __construct(
        ComponentService $componentService,
        SignalService $signalService,

    ){
        $this->componentService = $componentService;
        $this->signalService = $signalService;

    }
    public function index()
    {
        dd(444);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang,Request $request)
    {
        dd(555);
        $signalId = $this->store();


        return redirect()->route('signal.edit', ['signal' => $signalId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(): int
    {
        return $this->signalService->store();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
