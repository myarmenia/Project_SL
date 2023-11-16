<?php

namespace App\Http\Controllers\MiaSummary;

use App\Http\Controllers\Controller;
use App\Http\Requests\MiaSummaryRequest;
use App\Models\MiaSummary;
use App\Services\ComponentService;
use App\Services\MiaSummaryService;
use Illuminate\Http\Request;

class MiaSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $componentService;
    protected $miaSummaryService;

    public function __construct(
        ComponentService $componentService,
        MiaSummaryService $miaSummaryService,

    ){
        $this->componentService = $componentService;
        $this->miaSummaryService = $miaSummaryService;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang,Request $request)
    {
        // dd($request->bibliography_id);
        $miaSummaryId = $this->store($request->bibliography_id);
        // dd($miaSummaryId);

        return redirect()->route('mia-summary.edit', $miaSummaryId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($bibliograpy_id): int
    {
//    dd($bibliograpy_id);
        return $this->miaSummaryService->store($bibliograpy_id);
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
    public function edit($lang, MiaSummary $miaSummary)
    {

        return view('miasummary.edit',compact('miaSummary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($lang, MiaSummaryRequest $request, MiaSummary $miaSummary)
    {

        $updated_field = $this->miaSummaryService->update($miaSummary, $request->all());

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
