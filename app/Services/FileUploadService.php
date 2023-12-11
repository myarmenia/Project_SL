<?php

namespace App\Services;

use App\Models\Bibliography\Bibliography;
use App\Models\File\File;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    protected $searchService;
    // public $model;
    public function __construct(SearchService $searchService)
  {
    $this->searchService = $searchService;
  }


    public static function upload(array|object $data, string $folder_path)
    {
// dd($folder_path);
        $filename = md5(microtime()).'.'.$data->getClientOriginalExtension();

        $path = Storage::disk('local')->putFileAs(
            'public/'.$folder_path,
            $data,
            $filename
        );

        if($data->extension() == "doc"){
            $inputPath = storage_path('app/' . $path);
            $explodePath = explode('/', $path);
            $implotedArray = $explodePath[0] . '/' . $explodePath[1] . '/' . $explodePath[2] . '/' ;
            $convert = convertDocToDocx($inputPath, storage_path('app/'. $implotedArray));

            if($convert){
                if (file_exists($inputPath . 'x') && file_exists($inputPath)) {
                    $removePath = $inputPath;
                    Storage::delete($removePath);
                    $path = $path.'x';
                    $fileName = $filename.'x';
                    $fullPath = public_path(Storage::url('uploads/' . $fileName));
                }
            }

        }


        return $path;
    }


    public static function saveFile(object $man, object $file, string $dir): string
    {
        $fileData = self::saveGetFileData($file,$dir);

        return $man->file1()->create([
            'real_name' => $file->getClientOriginalName(),
            'name' => $fileData['name'],
            'path' => $fileData['path'],
        ]);
    }

    public static function savePhoto(object $file): int
    {
        return Photo::create([
            'image' => file_get_contents($file)
        ])->id;
    }


    public static function saveGetFileData(object $file, string $dir): array
    {
        $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();

        $path =  Storage::disk('public')->putFileAs($dir,$file,$fileName);

        return [
            'name' => $fileName,
            'path' => $path
        ];
    }

    public static function get_file(Request $request)
    {
        $path = $request['path'] ?? null;

        return response()->file(Storage::path($path));
    }

    public function addFile($fileName, $orginalName, $path): int
    {
        $fileDetails = [
            'name' => $fileName,
            'real_name' => $orginalName,
            'path' => $path,
        ];

        // $fileId = File::addFile($fileDetails);
        $fileId = $this->searchService->addFile($fileDetails);

        return $fileId;
    }


    public function delete(Request $request)
    {


        $id = $request['id'];
        $pivot_table_name = $request['pivot_table_name'];
        $model_name = $request['model_name'];
        $model_id = $request['model_id'];

        $model = app('App\Models\\'.$model_name.'\\'.$model_name);

        $find_model = $model::find($model_id);

        $find_model->$pivot_table_name()->detach($request['id']);

        if (count($find_model->$pivot_table_name) >= 1) {
            if ($find_model->country_id == $request['id'] || $find_model->country_id !== $request['id']) {
                foreach ($find_model->$pivot_table_name as $key => $value) {
                    $find_model->country_id = $value->pivot->country_id;
                    $find_model->save();
                }
            }
        } else {
            $find_model->country_id = null;
            $find_model->save();
        }

        return response()->json(['result' => 'deleted'], 200);
    }

    public function deleteItem(Request $request)
    {
// dd($request->all());
        $id = $request['id'];
        // $pivot_table_name=$request['pivot_table_name'];
        // $model_name=$request['model_name'];
        $model_id = $request['model_id'];

        $bibliography = Bibliography::find($model_id);
        $file = File::find($request['id']);
        $file_exst = explode('.', $file->real_name);

        if ($file_exst[1] == 'mp4' || $file_exst[1] == 'mov') {
            $bibliography->update([
                'video' => 0,
            ]);
        }

        $bibliography->files()->detach($request['id']);

        Storage::delete($file->path);
        $file->delete();

        return response()->noContent();
    }


}
