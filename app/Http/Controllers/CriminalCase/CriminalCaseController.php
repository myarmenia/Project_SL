<?php

namespace App\Http\Controllers\CriminalCase;

use App\Http\Controllers\Controller;
use App\Http\Requests\CriminalCaseRequest;
use App\Models\CriminalCase;
use App\Services\CriminalCaseService;
use App\Traits\HelpersTraits;
use Illuminate\Http\Request;

class CriminalCaseController extends Controller
{
    protected CriminalCaseService $criminalCaseService;

    public function __construct(CriminalCaseService $criminalCaseService)
    {
        $this->criminalCaseService = $criminalCaseService;
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
     * @return \Illuminate\Http\Response
     */
    public function create($lang, Request $request)
    {
        $criminal_case_id = $this->store($request->bibliography_id);

        return redirect()->route('criminal_case.edit', ['criminal_case' => $criminal_case_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($bibliography_id)
    {
        return $this->criminalCaseService->store($bibliography_id);
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
    public function edit($lang, CriminalCase $criminal_case)
    {
        return view('criminal-case.index', compact('criminal_case'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($lang, CriminalCaseRequest $request, CriminalCase $criminalCase)
    {
        $updated_field = $this->criminalCaseService->update($criminalCase, $request->validated());

        return HelpersTraits::backToRoute('open.criminal_case');
//        return response()->json(['result' => $updated_field]);
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
