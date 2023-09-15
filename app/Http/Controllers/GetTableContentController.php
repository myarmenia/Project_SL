<?php

namespace App\Http\Controllers;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $filename = preg_replace('"\.(doc)$"', '.docx', $request->file);
        // dd($filename);

    //     $fileHandle = fopen($request->file, "r");

    //     $line = @fread($fileHandle, filesize($request->file));
    //     $lines = explode(chr(0x0D),$line);
    //     $outtext = "";
    //     foreach($lines as $thisline)
    //       {

    //         $pos = strpos($thisline, chr(0x00));

    //         if (($pos !== FALSE)||(strlen($thisline)==0))
    //           {

    //           } else {
    //             $outtext .= $thisline." ";
    //           }
    //       }

    //     $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
    //    return $outtext;





        $file = $request->file('file');

        if ($request->hasFile('file')) {
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $fileName);
            $fullPath = storage_path('app/' . $path);

            $text = $this->tableContentService->get($fullPath,$request->column_name);
            dd($text);
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
