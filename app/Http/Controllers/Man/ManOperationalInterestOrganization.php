<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationalInterestCreateRequest;
use App\Models\Man\Man;
use App\Services\OperationalInterestService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class ManOperationalInterestOrganization extends Controller
{
    public function create($lang, Man $man): View
    {
        Session::put('route', 'operational-interest-organization-man.create');
        Session::put('model', $man);

        $teg = Session::get('modelId');
        if ($teg) {
            $teg = Man::find($teg);
        }

        return view('operation-interest.index', compact('man', 'teg'));
    }

    public function store($lang, Man $man,OperationalInterestCreateRequest $request): RedirectResponse
    {
        OperationalInterestService::store($man->id, $request->validated(),'organization');

        return redirect()->route('man.edit', $man->id);
    }
}
