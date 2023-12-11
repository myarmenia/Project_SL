<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManFileResource;
use App\Models\Man\Man;
use App\Models\ParagraphFile;
use App\Services\WordFileReadService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ManFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(private  WordFileReadService $wordFileReadService)
    {

        $this->wordFileReadService = $wordFileReadService;
    }

    public function index($lang,Request $request)
    {

        $man_file = Man::where('id',$request['id'])->with(['tmp_man','paragraph_files'])->get();
        // dd($man_file);
        // $download_file = ParagraphFile::where('id',7)->first();
// dd($download_file);
// $download_file_path=$download_file->path;

        return view('man-attached-paragraph.index',compact('man_file'));
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
        // dd($request->all());
        $now = \Carbon\Carbon::now()->format('Y_m_d_H_i_s');
        $reportType = 'Պատասխան_ֆայլ';
        $file_name = sprintf('%s_%s.docx',$reportType, $now);

        $attached_man_paragraph=$this->wordFileReadService->generate_file_via_man_paragraph($request->all(),$file_name);
        $message = '';

        if($attached_man_paragraph){
            $paragraph_file_path = "public/man_attached_file/". $file_name;
            $request['path']=$paragraph_file_path;
// $this->download($request);
            $message =$paragraph_file_path;

        }else{
            $message ='response file not generated';
        }

         return response()->json(['message'=>$message]);



    }
    public function download(Request $request)
    {
// dd($request['path']);

        return Storage::download($request['path']);
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
