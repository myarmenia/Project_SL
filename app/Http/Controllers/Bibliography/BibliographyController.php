<?php

namespace App\Http\Controllers\Bibliography;

use App\Http\Controllers\Controller;
use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
use App\Models\TempTables\TmpManFindText;
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
        // dd(Bibliography::find(5)->files()->viasummary());
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

        $updated_field = $this->bibliographyService->update($request, 'bibliography', $bibliography->id);

        if ($request->fieldName == 'country_id') {
            // dd($updated_field);
            return response()->json(['result' => $updated_field]);
        }
        return response()->noContent();
    }

    public function updateFile($lang, Request $request, Bibliography $bibliography)
    {
      
        $this->bibliographyService->updateFile($request, 'bibliography', $bibliography->id);

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

    public function getManParagraph(Request $request){
        // dd($lang);
        // dd($request[0]);
        $find_man = Man::find($request[0]);
        $first_name = $find_man->firstName->first_name;
        $last_name = $find_man->lastName->last_name;
        $middle_name = $find_man->middleName!=null ? $find_man->middleName->middle_name : null;
        $birthday_str = $find_man->birthday_str!=null ? $find_man->birthday_str :null;
        // dd($first_name, $last_name,$middle_name,$birthday_str);
        $tmp_man_find_text=TmpManFindText::where([
            ['name','=',$first_name],
            ['surname','=',$last_name],
            ['patronymic','=',$middle_name],
            ['birthday','=',$birthday_str],
        ])->first();
        $find_paragraph = $tmp_man_find_text->paragraph;
        return response()->json(['result'=>$find_paragraph],200);


    }
}
