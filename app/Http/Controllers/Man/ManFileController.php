<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManFileResource;
use App\Models\Man\Man;
use App\Services\WordFileReadService;
use Illuminate\Http\Request;

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

        $man_file = Man::where('id',$request['id'])->with('tmp_man')->get();

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
        $attached_man_paragraph=$this->wordFileReadService->generate_file_via_man_paragraph($request->all());
        $message ='';
        if($attached_man_paragraph){

            $message ='file_has_been_gererated';

        }else{
            $message ='response file not generated';
        }

         return response()->json(['message'=>$message]);



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
