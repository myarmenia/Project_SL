<?php

namespace App\Http\Controllers;

use App\Models\File\File;
use App\Models\FirstName;
use App\Models\LastName;
use App\Models\Man\Man;
use App\Models\MiddleName;
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

    public function __construct(TableContentService $tableContentService){

        $this->tableContentService = $tableContentService;
    }
    public function index()
    {
        return view('table-content.index');
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
    public function store(Request $request)
    {
// dd($request->all());
        if ($request->hasFile('file')) {
            $file = $request->file('file');
          
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $fileName);
            $fullPath = storage_path('app/' . $path);
            $fileId =  $this->addFile($fileName, $file->getClientOriginalName(), $path);
            $text = $this->tableContentService->get($fullPath,$request->column_name, $file, $fileName, $path,$request->lang,$request->title, $fileId);
            // $text = $this->tableContentService->get($file,$request->column_name);
            // dd($text);
            if($text){

                $man=Man::all();
                // dd($man);
                // dd($man[0]->file->name);
                return view('table-content.single-upload',compact('man'));



            }

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
        //
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
