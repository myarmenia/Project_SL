<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManEmailCreateRequest;
use App\Models\Email;
use App\Models\Man\Man;
use App\Services\EmailService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManEmailController extends Controller
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
     * @return Application|Factory|View
     */
    public function create($langs, Man $man): View|Factory|Application
    {
        $manId = $man->id;

        return view('email.index', compact('manId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManEmailCreateRequest  $request
     * @param  Man  $man
     * @return RedirectResponse
     */
    public function store($langs, ManEmailCreateRequest $request, Man $man): RedirectResponse
    {
        EmailService::store($man, $request->validated());

        return redirect()->route('man.edit',$man);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($langs)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
