<?php

namespace App\Services;

use App\Models\Bibliography\BibliographyHasCountry;
use App\Models\Bibliography\BibliographyHasFile;
use App\Models\File\File;
use App\Services\Form\FormContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ComponentService
{


    /**
     * @param  object  $man
     * @param  array  $attributes
     * @param  string  $relation
     * @return void
     */
    public static function storeHasMany(object $man, array $attributes, string $relation): void
    {
        $man->hasManyRelation($relation)->create($attributes);
    }

    /**
     * @param  object  $man
     * @param  array  $attributes
     * @param  string  $table
     * @return void
     */
    public static function storeBelongsToMany(object $man, array $attributes, string $table): void
    {
        $man->belongsToManyRelation($table)->create($attributes);
    }

    public static function storeInsertRelations(
        object $man,
        string $mainTable,
        array $mainAttributes,
        array $relationAttributes
    ): void {
        $tableId = DB::table($mainTable)->insertGetId($mainAttributes);

        DB::table('man_has_' . $mainTable)->insert(
            [
                'man_id' => $man->id,
                $mainTable . '_id' => $tableId,
            ] + $relationAttributes
        );
    }


    public function update($request,  $table_name, $table_id)
    {
        // dd($request->all());
        $updated_feild = $request['fieldName'];

        $value = $request['value'];
       

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

        if ($request['fieldName'] == 'file') {

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


        }
    }

    public function get_section(Request $request)
    {
        // dd($request->all());

        $table = DB::table($request->table_name)->orderBy('id','desc')->get();
        $model_name = $request->table_name;


        return response()->json(['result' => $table, 'model_name' => $model_name,]);
    }
    public function storeTableField($lang, Request $request)
    {

         DB::table($request['table_name'])->updateOrInsert([
            $request['fieldName'] =>$request['value']
        ]);

        $table = DB::table($request['table_name'])->orderBy('id','desc')->get();
        $model_name = $request['table_name'];

        return response()->json(['result' => $table, 'model_name' => $model_name,]);
    }


    public $search = [];
    public function filter(Request $request)
    {
        // dd($request->all());
        $model_name = $request->path;


        $query = DB::table($request->path)->where('name', 'like', $request->name .'%')->orderBy('id','desc')->get();
// dd($query);

        foreach ($query as $key => $item) {

            $this->search[$item->id] = $item->name;
        }
        $validate=[];
        if (count($this->search) === 0) {
            $validate['result_search_dont_matched']='required';
            $validator = Validator::make($request->all(),$validate);
            if($validator->fails()){

                // return response()->json(['result' => ''], 400);
                return response()->json(['errors' => $validator->errors()], 400);

            }



        } else {

            return response()->json(['result' => $this->search, 'model_name' => $model_name, 'section_id' => $request->path]);
        }
    }
}
