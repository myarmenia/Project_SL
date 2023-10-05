<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailCreateRequest;
use App\Http\Requests\ManFieldsUpdateRequest;
use App\Models\Email;
use App\Models\Man\Man;
use App\Services\ComponentService;
use App\Services\EmailService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
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
     * @param $langs
     * @param  Man  $man
     * @return Application|Factory|View
     */
    public function create($langs, Man $man): View|Factory|Application
    {
        $manId = $man->id;

        return view('email.email', compact('manId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  ManFieldsUpdateRequest  $request
     * @param  Man  $man
     * @return View|Factory|Application
     */
    public function store($langs, ManFieldsUpdateRequest $request, Man $man): View|Factory|Application
    {
        $manId = ComponentService::store($man, $request->validated());

        return view('man.index', compact('manId'));
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
