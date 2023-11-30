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
        // dd($request->all(), $table_name,$table_id);
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
        $log = LogService::store($request->all(), $table_id, 'bibliography','update');


        $table=DB::table($table_name)->where('id', $table_id)->update([
            $updated_feild=>$value
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


            if($file) {

                BibliographyHasFile::bindBibliographyFile($table_id, $file);

                $getMimeType=$value->getClientMimeType();
               if($getMimeType == 'video/mp4' || $getMimeType =='video/mov'){

                    $find_table_row = DB::table($table_name)->where('id', $table_id)->update([
                        'video' => 1
                    ]);

               }
            }
            return $file;



    }
}
