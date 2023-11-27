<?php
namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use PhpOffice\PhpWord\IOFactory;

class WordFileReadService
{
    public function read_word($fullPath,$text,$search_word){
        $arr=[];

        $explode_text = explode("\t",$text);
        // dd($explode_text);
        foreach($explode_text as $item){
            $exploded_iner_text=explode(" ",$item);
            foreach($exploded_iner_text as $data){
                // dd($data);
                if(Str::contains($data,$search_word)){
                    array_push($arr,$item);
                }


            }
        }
        // dd($arr);
        if(count($arr)>0){
            $now = \Carbon\Carbon::now()->format('Y_m_d_H_i_s');
            $reportType='generated_file_via_paragraph';
            $name = sprintf('%s_%s.docx',$reportType, $now);
            $user=Auth::user()->first_name.' '.Auth::user()->last_name;

            Artisan::call('generate:word', ['name' => $name,'data' => $arr ,'reportType'=> $reportType,'user'=>$user] );

            if(Storage::disk('generate_file')->exists($name)){

                return Storage::disk('generate_file')->download($name);

            }

        }
    }

}
