<?php

namespace App\Http\Controllers;

use App\Models\CheckUserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class CheckedUserListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $check_user_list=CheckUserList::all();
//       dd($check_user_list);

        return view('user_list.index',compact('check_user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        // dd($request->all());
            $status = $request['status'];
            // dd($status);
            $get_user_status = CheckUserList::where('status',$status)->get()->toArray();
             $now = \Carbon\Carbon::now()->format('Y_m_d_H_i_s');
                    $reportType= $status;
                    // dd($reportType);
                    $name = sprintf('%s_%s.docx',$reportType, $now);
                if(count($get_user_status)>0){

                    Artisan::call('generate:word_doc_after_search', ['name' => $name,'data' => $get_user_status ,'reportType'=> $reportType] );

                }else{

                    $validated = [
                        'status_abssent' => ['required'],

                    ];

                    $validator=Validator::make($request->all(),$validated);
                    if ($validator->fails()) {
                        return response()->json(['message'=>$validator->errors()]);

                    }

                }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $user_id=$request['user_id'];
        $status=$request['status'];

        $update_user=CheckUserList::find($user_id);
        $update_user->status=$status;
        $update_user->save();
        $user = CheckUserList::where('id',$user_id)->get();
        return response()->json(["message"=>$user]);
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
