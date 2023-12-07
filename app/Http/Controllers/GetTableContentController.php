<?php

namespace App\Http\Controllers;

use App\Models\CheckUserList;
use App\Models\File\File;
use App\Models\FileHasUrlData;
use App\Services\ExcelFileReaderService;
use App\Services\PdfFileReaderService;
use App\Services\TableContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class GetTableContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $tableContentService;
    protected $excelFileReaderService;
    protected $pdfFileReaderService;

    public function __construct(TableContentService $tableContentService,ExcelFileReaderService  $excelFileReaderService,PdfFileReaderService $pdfFileReaderService){

        $this->tableContentService = $tableContentService;
        $this->excelFileReaderService = $excelFileReaderService;
        $this->pdfFileReaderService = $pdfFileReaderService;

    }
    public function index(Request $request)

    {
        $bibliographyId=$request->bibliography_id;

        return view('table-content.index',compact('bibliographyId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$lang)
    {

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $dataForUrl = $request->only(['table_name', 'colum_name_id', 'colum_name', 'bibliography_id']);

            $fileName = '';

            if($file->extension()=='xlsx' || $file->extension()=='xls'){

                $fileName =$this->excelFileReaderService->get($request->all());
                if(is_array($fileName)){

                    $check_user=CheckUserList::all();

                    return redirect()->route('checked_user_list', ['locale' => app()->getLocale(), 'check_user' => $check_user]);

                }
                // dd($fileName);
            }
            if($file->extension()=='pdf'){
                $fileName = $this->pdfFileReaderService->get($request->all());

                if(is_array($fileName)){

                    $check_user=CheckUserList::all();

                    return redirect()->route('checked_user_list', ['locale' => app()->getLocale(), 'check_user' => $check_user]);
                }

            }
            if($file->extension()=='docx' || $file->extension()=='doc'){
                $fileName = $this->tableContentService->get($request->all());

                if(is_array($fileName)){

                    $check_user=CheckUserList::all();

                    return redirect()->route('checked_user_list', ['locale' => app()->getLocale(), 'check_user' => $check_user]);

                }

            }

            if($request->filled('table_name')){
                FileHasUrlData::create([
                    'file_name' => $fileName,
                    'url_data' => json_encode($dataForUrl)
                ]);
            }


            return redirect()->route('checked-file-data.file_data', ['locale' => app()->getLocale(), 'filename' => $fileName]);



        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
