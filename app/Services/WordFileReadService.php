<?php
namespace App\Services;

use App\Models\File\File;
use App\Models\File\FileText;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
            $reportType='Պատասխան ֆայլ';
            $file_name = sprintf('%s_%s.docx',$reportType, $now);
            $user=Auth::user()->first_name.' '.Auth::user()->last_name;
            $datetime = \Carbon\Carbon::now()->format('d-m-Y H:i');
            $day = \Carbon\Carbon::now()->format('d-m-Y');

            $result = Artisan::call('generate:word', ['file_name' => $file_name,'data' => $files_data_content_array,'role_name'=> $role_name,'user'=>$user,'world'=>$search_word,'datetime'=>$datetime,'day'=>$day] );

            return $result;


        }
    }

}
