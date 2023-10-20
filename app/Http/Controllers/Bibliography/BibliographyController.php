<?php

namespace App\Http\Controllers\Bibliography;

use App\Http\Controllers\Controller;
use App\Http\Requests\BibliographyRequest;
use App\Models\Bibliography\Bibliography;
use App\Services\BibliographyService;
use App\Services\ComponentService;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;

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


    // public function create() {

    //     $getbibliography = Bibliography::getBibliography();
    //     // $agency = Agency::all();
    //     return view('bibliography.index', compact('getbibliography'));
    // }
    // public function get_section(Request $request){
    //     // dd($request['table_name']);
    //     $table = DB::table($request['table_name'])->get();
    //     $model_name = $request->table_name;

    //     return response()->json(['result'=>$table,'model_name'=>$model_name,]);
    // }
    // public function update(Request $request,$lang, $id){
    //     // dd($request->all());


    //     $store_bibliograph = Bibliography::updateBibliography($request->all(),$id);


    //     return response()->json(['message'=>$store_bibliograph]);
    // }


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
    public function update($lang, BibliographyRequest $request,  Bibliography $bibliography):Response | JsonResponse
    {

        // dd($request->all());

      $updated_field = $this->componentService->update($request, 'bibliography', $bibliography->id);
        if($request->fieldName=='country_id'){
            // dd($updated_field);
            return response()->json(['result'=>$updated_field]);

        }
        return response()->noContent();

    }

    public function updateFile($lang, Request $request, Bibliography $bibliography)
    {
        // dd($request->all());
        $this->componentService->updateFile($request, 'bibliography', $bibliography->id);

        return response()->noContent();
    }
}
