<?php

namespace App\Http\Controllers\Signal;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeepSignalRequest;
use App\Models\KeepSignal;
use App\Services\ComponentService;
use App\Services\KeepSignalService;
use Illuminate\Http\Request;

class KeepSignalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $componentService;
    protected $keepSignalService;
    public function __construct(

        ComponentService $componentService,
        KeepSignalService $keepSignalService,

    ){

        $this->keepSignalService = $keepSignalService;

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
        $keepsignalId = $this->store($request->signal_id);
        // dd($keepsignalId);

        return redirect()->route('keepSignal.edit',  $keepsignalId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($signal_id): int
    {
        return $this->keepSignalService->store($signal_id);
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
    public function edit($lang, KeepSignal $keepSignal)
    {
// dd($keepSignal);
        return view('signal.keepsignal',compact('keepSignal'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($lang, KeepSignalRequest $request, KeepSignal $keepSignal)
    {
// dd($keepSignal);
        $updated_field = $this->keepSignalService->update($keepSignal, $request->all());

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
