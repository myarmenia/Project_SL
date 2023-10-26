<?php

namespace App\Http\Controllers;

use App\Models\File\File;
use App\Models\FirstName;
use App\Models\LastName;
use App\Models\Man\Man;
use App\Models\MiddleName;
use App\Services\ExcelFileReaderService;
use App\Services\PdfFileReaderService;
use App\Services\TableContentService;

use Illuminate\Http\Request;


class GetTableContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $tableContentService;
    protected $excelFileReaderService;

    public function __construct(TableContentService $tableContentService,ExcelFileReaderService  $excelFileReaderService){

        $this->tableContentService = $tableContentService;
        $this->excelFileReaderService = $excelFileReaderService;

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

    public function addFile($fileName, $orginalName, $path): int
    {
        $fileDetails = [
            'name' => $fileName,
            'real_name' => $orginalName,
            'path' => $path
        ];

        $fileId = File::addFile($fileDetails);

        return $fileId;
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

            $fileName = '';

            if($file->extension()=='xlsx'){

                $fileName = ExcelFileReaderService::get($request->all());
            }
            if($file->extension()=='pdf'){
                $fileName = PdfFileReaderService::get($request->all());
            }
            if($file->extension()=='docx'){

                $fileName = $this->tableContentService->get($request->all());
            }




                    // $file=File::find($read_file);
                    // $men_in_file=$file->man;

            return redirect()->route('checked-file-data.file_data', ['locale' => app()->getLocale(), 'filename' => $fileName]);
                // return view('table-content.single-upload',compact('men_in_file'));

           

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
