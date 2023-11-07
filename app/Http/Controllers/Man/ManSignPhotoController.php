<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManExternalSignPhotoCreateRequest;
use App\Models\Man\Man;
use App\Services\SignPhotoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManSignPhotoController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @param $langs
     * @param  Man  $man
     * @return View|Factory|Application
     */
    public function create($langs, Man $man): View|Factory|Application
    {
        return view('external-signs-image.external-signs-image', compact('man'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManExternalSignPhotoCreateRequest  $request
     * @param  Man  $man
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($langs, ManExternalSignPhotoCreateRequest $request, Man $man): \Illuminate\Http\RedirectResponse
    {
        SignPhotoService::store($man, $request->validated());

        return redirect()->route('man.edit', $man);
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
