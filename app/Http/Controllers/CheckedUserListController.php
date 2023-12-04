<?php

namespace App\Http\Controllers;

use App\Models\CheckUserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
        $check_user_list = CheckUserList::all();
        //       dd($check_user_list);

        return view('user_list.index', compact('check_user_list'));
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
        $get_user_status = CheckUserList::where('status', $status)->get()->toArray();

        $role_name = '';

        foreach (Auth::user()->roles as $key => $role) {

            if ($key > 0) {
                $role_name .= '-';
            }
            $role_name .= $role->name;
        }
        $now = \Carbon\Carbon::now()->format('Y_m_d_H_i_s');
        $reportType = $status;
        // dd($reportType);
        if($reportType=="like"){
            $reportType="Անցնողներ";
        }
        if($reportType=="some"){
            $reportType="Ոմանք";
        }
        if($reportType=="new"){
            $reportType="Բացակայողներ";
        }

        $name = sprintf('%s_%s.docx', $reportType, $now);
        if (count($get_user_status) > 0) {
            $user = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $datetime = \Carbon\Carbon::now()->format('d-m-Y H:i');
            $day = \Carbon\Carbon::now()->format('d-m-Y');


            $result = Artisan::call('generate:word_doc_after_search', ['name' => $name, 'datetime' => $datetime, 'user' => $user, 'role_name' => $role_name, 'data' => $get_user_status, 'reportType' => $reportType,'day'=>$day]);

            $message = "";
            if ($result) {
                $message ='file_has_been_generated';
            }else{
                $message ='response_file_not_generated';
            }
            return response()->json(['message' => $message]);
        } else {

            $validated = [
                'status_abssent' => ['required'],

            ];

            $validator = Validator::make($request->all(), $validated);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()]);
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

        $user_id = $request['user_id'];
        $status = $request['status'];

        $update_user = CheckUserList::find($user_id);
        $update_user->status = $status;
        $update_user->save();
        $user = CheckUserList::where('id', $user_id)->get();
        return response()->json(["message" => $user]);
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
