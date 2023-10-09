<?php

namespace App\Http\Controllers\Bibliography;

use App\Http\Controllers\Controller;
use App\Models\AccessLevel;
use App\Models\Agency;
use App\Models\Bibliography\Bibliography;
use App\Models\Bibliography\BibliographyHasFile;
use App\Models\Country;
use App\Models\DocCategory;
use App\Models\User;
use App\Services\BibliographyService;
use App\Services\ComponentService;
use App\Services\FileUploadService;
use App\Services\Form\FormContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BibliographyController extends Controller
{
    public $formContentService;
    protected $componentService;
    protected $bibliographyService;

    public function __construct(FormContentService $formContentService, ComponentService $componentService, BibliographyService $bibliographyService)
    {

        $this->formContentService = $formContentService;
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

    public function update(Request $request, $lang, Bibliography $bibliography)
    {
        $this->componentService->update($request, 'bibliography', $bibliography->id);

        return response()->noContent();
    }

    public function updateFile($lang, Request $request, Bibliography $bibliography)
    {
        $this->componentService->updateFile($request, 'bibliography', $bibliography->id);

        return response()->noContent();
    }
}
