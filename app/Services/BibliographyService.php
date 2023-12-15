<?php

namespace App\Services;

use App\Models\Bibliography\Bibliography;
use App\Models\Bibliography\BibliographyHasCountry;
use App\Models\Bibliography\BibliographyHasFile;
use App\Models\File\File;
use App\Services\Log\LogService;
use Illuminate\Support\Facades\DB;

class BibliographyService
{


    /**
     * @return int
     */
    public function store(): int
    {

        return Bibliography::create(['user_id' => auth()->id()])->id;
    }
    public function update($request,  $table_name, $table_id)
    {
        // dd($request->all());
        $updated_feild = $request['fieldName'];


        $value = '';

        if($request->has('delete_relation')){
            if($request->delete_relation==true){
                $value = null;


            }

        }else{
            $value = $request['value'];

        }
        if($updated_feild == 'file_comment'){
            // dd($updated_feild,$value, $request->file_id);
            $file=File::find($request->file_id)->update([
                $updated_feild=>$value
            ]);
            $updated_file=File::where('id',$request->file_id)->first();

            // dd($file);

            return $updated_file;

        }
        $updated = [$updated_feild=>$value];

        $log = LogService::store($updated, $table_id, 'bibliography','update');


        $table = DB::table($table_name)->where('id', $table_id)->update([
            $updated_feild => $value
        ]);

        if($updated_feild == 'country_id'){
           $bind_country = BibliographyHasCountry::bindBibliographyCountry($table_id,$value);
           if($bind_country){

                $table = DB::table('country')->where('id',$value)->first();

                return $table;

           }

        }

        $table=DB::table($table_name)->where('id',$table_id)->first();


        return  $table;
    }
    public function updateFile($request, $table_name, $table_id)
    {

        $updated_feild = $request['fieldName'];
        $value = $request['value'];

            $folder_path = $table_name . '/' . $table_id;
            $fileName = time() . '_' . $value->getClientOriginalName();

            $path = FileUploadService::upload($value, $folder_path);
            $file_content=[];
            $file_content['name']=$fileName;
            $file_content['real_name']=$value->getClientOriginalName();
            $file_content['path'] = $path;

            $file = DB::table('file')->insertGetId($file_content);

            $log = LogService::store($file_content,  $file, 'file','create');

            if($file) {

                BibliographyHasFile::bindBibliographyFile($table_id, $file);

                $getMimeType=$value->getClientMimeType();
               if($getMimeType == 'video/mp4' || $getMimeType =='video/mov'){






                    $update_file = DB::table('file')->where('id',$file)->update([
                        'video' => 1
                    ]);
                    $get_count_video=self::check_video_count($table_id);


                    $find_table_row = DB::table($table_name)->where('id', $table_id)->update([
                        'video' => $get_count_video >0 ? 1 : 0 ,
                    ]);

               }
            }
            return $file;



    }
    public static function check_video_count(){
        $bib=Bibliography::find(14);
        // dd($bib->files);
        $count=0;
        if(isset($bib->files)){

            foreach($bib->files as $fl){
                // dd
                if($fl->video==1){
                    $count+=1;
                }

            }
        }
        // dd($count);
        return $count;

    }
}
