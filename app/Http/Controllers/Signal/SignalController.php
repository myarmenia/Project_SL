<?php

namespace App\Http\Controllers\Signal;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignalRequest;
use App\Models\Signal;
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang,Request $request)
    {
               $signalId = $this->store($request->bibliography_id);
        return redirect()->route('signal.edit', ['signal' => $signalId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($bibliography_id): int
    {
        return $this->signalService->store($bibliography_id);
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
    public function edit($lang, Signal $signal)
    {
// dd($signal);
        return view('signal.edit',compact('signal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($lang, SignalRequest $request, Signal $signal)
    {

        $updated_field = $this->signalService->update($signal, $request->all());

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
