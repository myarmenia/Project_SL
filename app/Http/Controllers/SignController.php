<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManExternalSignCreateRequest;
use App\Models\Man\Man;
use App\Services\SignService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function create($langs, Man $man)
    {
        return view('external-signs.index', compact('man'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManExternalSignCreateRequest  $request
     * @param  Man  $man
     * @return mixed
     */

    public function store($langs, ManExternalSignCreateRequest $request, Man $man): mixed
    {
        SignService::store($man,$request->validated());

        return redirect()->route('man.edit',$man);
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
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
