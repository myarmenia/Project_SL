<?php

namespace App\Http\Controllers;

use App\Models\Log\Log;
use Illuminate\Http\Request;

class LogingController extends Controller
{
    public function index(Request $request){

        $logs = Log::orderBy('id', 'DESC')->paginate(15);

        return view('loging.index', compact('logs'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    public function getLogById($lang,$logId){

        $jsonString = '{"roles": ["ddd"], "password": "123456", "username": "edde", "last_name": "eded", "first_name": "eded", "confirm-password": "123456"}';

// Step 1: Convert JSON string to PHP array
        $dataArray = json_decode($jsonString, true);

// Step 2: Check if "roles" key exists in the array
        if (isset($dataArray['roles'])) {
//            dd($dataArray['username']);
            // Step 3: Iterate over the "roles" array using foreach
            foreach ($dataArray['roles'] as $role) {
                // Do something with each role
                echo $role['password'];
            }
        } else {
            // Handle the case where "roles" key is not present in the array
            echo "No roles found.\n";
        }
        dd('dd');
       $log = Log::find($logId);
       $getLogsByIdTable = Log::where('tb_name',$log->tb_name)->where('tb_id',$log->tb_id)->get();
       dd($getLogsByIdTable);
    }
}
