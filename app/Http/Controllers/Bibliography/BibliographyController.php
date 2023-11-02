<?php

namespace App\Http\Controllers\Bibliography;

use App\Http\Controllers\Controller;
use App\Models\Bibliography\Bibliography;
use App\Services\BibliographyService;
use App\Services\ComponentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BibliographyController extends Controller
{

    protected $componentService;
    protected $bibliographyService;

    public function __construct(

        ComponentService $componentService,
        BibliographyService $bibliographyService
    ) {

        $this->componentService = $componentService;
        $this->bibliographyService = $bibliographyService;
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        $bibliographyId = $this->store();


        return redirect()->route('bibliography.edit', ['bibliography' => $bibliographyId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return int
     */
    public function store(): int
    {
        return $this->bibliographyService->store();
    }


    public function edit($lang, Bibliography $bibliography)
    {

        return view('bibliography.edit', compact('bibliography'));
    }

    /**
     * @param  Request  $request
     * @param $lang
     * @param  Bibliography  $bibliography
     * @return Response
     */
    public function update($lang, Request $request,  Bibliography $bibliography): Response | JsonResponse
    {

        // dd($request->all());

        $updated_field = $this->componentService->update($request, 'bibliography', $bibliography->id);
        if ($request->fieldName == 'country_id') {
            // dd($updated_field);
            return response()->json(['result' => $updated_field]);
        }
        return response()->noContent();
    }

    public function updateFile($lang, Request $request, Bibliography $bibliography)
    {
        // dd($request->all());
        $this->componentService->updateFile($request, 'bibliography', $bibliography->id);

        return response()->noContent();
    }
    public function deleteteTeg(Request $request)
    {
        $pivot_table_name = $request['pivot_table_name'];
        $find_model = Bibliography::find($request['model_id']);
        $find_model->$pivot_table_name()->detach($request['id']);
        $countryId = $find_model->$pivot_table_name()->exists() ? $find_model->$pivot_table_name->first()->pivot->country_id : null;
        $find_model->update(['country_id' => $countryId]);
        return response()->json(['result' => 'deleted'], 200);
    }
}
