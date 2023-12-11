<?php
namespace App\Services;

use App\Models\File\File;
use App\Models\File\FileText;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class WordFileReadService
{
    public function generate_file_via_man_paragraph($request,$file_name){
// dd($request);
        // $search_word=$request['search_word'];

        $files_data_content_array=$request['paragraphs'];

        $role_name='';

        foreach(Auth::user()->roles as $key=>$role){

            if($key>0){
                $role_name.='-';
            }
            $role_name.=$role->name;
        }

        if(count($files_data_content_array)>0){

            $user=Auth::user()->first_name.' '.Auth::user()->last_name;
            $datetime = \Carbon\Carbon::now()->format('d-m-Y H:i');
            $day = \Carbon\Carbon::now()->format('d-m-Y');
            $man_id=$request['manId'];

            $result = Artisan::call('generate:word', ['file_name' => $file_name,'data' => $files_data_content_array,'role_name'=> $role_name,'user'=>$user,'datetime'=>$datetime,'day'=>$day,'man_id'=>$man_id]);

            return $result;


        }

    }


}
