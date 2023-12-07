<?php

namespace App\Http\Controllers\Signal;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeepSignalRequest;
use App\Models\KeepSignal;
use App\Services\ComponentService;
use App\Services\KeepSignalService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use App\Services\Log\LogService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $keepSignal=$this->keepSignalService->store($signal_id);
        $log = LogService::store(null, $keepSignal, 'keep_signal', 'create');
        return $keepSignal;
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
     * @param  KeepSignal  $keepSignal
     * @return Application|Factory|View
     */
    public function edit($lang, KeepSignal $keepSignal)
    {
// dd($keepSignal);
        return view('signal.keepsignal',compact('keepSignal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $lang
     * @param  KeepSignalRequest  $request
     * @param  KeepSignal  $keepSignal
     * @return JsonResponse
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
