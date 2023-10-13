<?php

namespace App\Services;

use App\Models\Bibliography\Bibliography;
use App\Models\File\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{

    public static function upload(array|object $data, string $folder_path)
    {
// dd($folder_path);
        $filename = md5(microtime()). '.' .$data->getClientOriginalExtension();

        $path = Storage::disk('local')->putFileAs(
          'public/' . $folder_path,
          $data,
          $filename
        );

        return $path;

    }

    public static function get_file(Request $request)
    {
        $path = $request['path'] ?? 'public/null_image.png';
        return response()->file(Storage::path($path));
    }

    public static function addFile($fileName, $orginalName, $path): int
    {
        $fileDetails = [
            'name' => $fileName,
            'real_name' => $orginalName,
            'path' => $path
        ];

        $fileId = File::addFile($fileDetails);

        return $fileId;
    }

    public function delete(Request $request ){
        $id=$request['id'];
        $pivot_table_name=$request['pivot_table_name'];
        $model_name=$request['model_name'];
        $model_id=$request['model_id'];

        // dd($request['pivot_table_name']);
        $bibliography = Bibliography::find($model_id);


        $bibliography->country()->detach($request['id']);
        if(count($bibliography->country)>=1){

            if( $bibliography -> country_id == $request['id']){

                foreach ($bibliography->country as $key => $value) {

                    $bibliography -> country_id = $value->pivot->country_id;
                    $bibliography -> save();
                }
            }
        }else{

            $bibliography -> country_id = Null;
            $bibliography -> save();

        }


        return response()->json(['result'=>'deleted']);



    }

    public function deleteItem(Request $request ){

        $id=$request['id'];
        // $pivot_table_name=$request['pivot_table_name'];
        // $model_name=$request['model_name'];
        $model_id = $request['model_id'];

        $bibliography = Bibliography::find($model_id);
        $file = File::find($request['id']);

        $bibliography->files()->detach($request['id']);

        Storage::delete( $file->path);
        $file->delete();



        return response()->noContent();

    }


}
