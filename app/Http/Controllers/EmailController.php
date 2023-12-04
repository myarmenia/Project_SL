<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailCreateRequest;
use App\Models\Email;
use App\Services\EmailService;
use App\Traits\HelpersTraits;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param $langs
     * @return Application|Factory|View
     */
    public function create($langs): View|Factory|Application
    {
        $modelData = HelpersTraits::getModelFromUrl(new Email());

        return view('email.index', compact('modelData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $langs
     * @param  EmailCreateRequest  $request
     * @return RedirectResponse
     */
    public function store($langs, EmailCreateRequest $request): RedirectResponse
    {

        $modelData = HelpersTraits::getModelFromUrl();

        EmailService::store($modelData, $request->validated());

        return  HelpersTraits::backToRoute('email');
    }

    /**
     * @param $lang
     * @param  Email  $email
     * @return Application|Factory|View
     */
    public function edit($lang, Email $email)
    {
        $edit = true;
        $showRelation = request()->model;

        $modelData = HelpersTraits::getModelFromUrl($email);

        return view('email.index', compact('modelData','edit','showRelation','email'));
    }

    /**
     * @param $langs
     * @param  Email  $email
     * @param  EmailCreateRequest  $request
     * @return RedirectResponse
     */
    public function update($langs, Email $email, EmailCreateRequest $request)
    {

        $modelData = HelpersTraits::getModelFromUrl($email);

        EmailService::update($email, $request->validated(), $modelData);

        if (request()->model) {
            return redirect()->route(request()->model.'.edit', request()->id);
        }

        return  HelpersTraits::backToRoute('email');
    }
}
