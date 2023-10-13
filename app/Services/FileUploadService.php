<?php

namespace App\Services;

use App\Models\Bibliography\Bibliography;
use App\Models\File\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    // public $model;
    // public function __construct(Bibliography $model)
    // {
    //     $this->model = $model;

    // }


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


    public function delete(Request $request  ){
        // dd($request->all());

        $id = $request['id'];
        $pivot_table_name = $request['pivot_table_name'];
        $model_name = $request['model_name'];
        $model_id = $request['model_id'];


        $model = app('App\Models\\'.$model_name.'\\'.$model_name);

        $find_model = $model::find($model_id);

        $find_model->$pivot_table_name()->detach($request['id']);

        if(count($find_model->$pivot_table_name)>=1){

            if( $find_model->country_id == $request['id'] || $find_model->country_id !== $request['id']){

                foreach ($find_model->$pivot_table_name as $key => $value) {
                    $find_model->country_id = $value->pivot->country_id;
                    $find_model->save();
                }
            }
        }
        else{

            $find_model -> country_id = Null;
            $find_model -> save();
        }

        return response()->json(['result'=>'deleted'],200);

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
