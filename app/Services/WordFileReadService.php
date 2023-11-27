<?php
namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use PhpOffice\PhpWord\IOFactory;

class WordFileReadService
{
    public function read_word($request){

        $search_word=$request['search_word'];

        $files_data_content_array=$request['files_data'];

        $role_name='';

        foreach(Auth::user()->roles as $key=>$role){

            if($key>0){
                $role_name.='-';
            }
            $role_name.=$role->name;
        }

        if(count($files_data_content_array)>0){
            $now = \Carbon\Carbon::now()->format('Y_m_d_H_i_s');
            $reportType='generated_file_via_paragraph';
            $file_name = sprintf('%s_%s.docx',$reportType, $now);
            $user=Auth::user()->first_name.' '.Auth::user()->last_name;

            Artisan::call('generate:word', ['file_name' => $file_name,'data' => $files_data_content_array,'role_name'=> $role_name,'user'=>$user,'world'=>$search_word,'datetime'=>$now] );

            // if(Storage::disk('generate_file')->exists($name)){

            //     return Storage::disk('generate_file')->download($name);

            // }

        }
    }

}
