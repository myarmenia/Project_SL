<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Bibliography\BibliographyHasFile;
use App\Services\Form\FormContentService;
use Illuminate\Http\Request;

class ComponentService
{
    protected $formContentService;

    public function __construct(FormContentService $formContentService)
    {

        $this->formContentService = $formContentService;
    }

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
        $updated_feild = $request['fieldName'];

        $value = $request['value'];

        $this->formContentService->update($table_name, $table_id, $updated_feild, $value);
    }

    public function updateFile($request, $table_name, $table_id)
    {
        $updated_feild = $request['fieldName'];
        $value = $request['value'];

        if ($request['fieldName'] == 'file') {
            $folder_path = $table_name . '/' . $table_id;
            $fileName = time() . '_' . $value->getClientOriginalName();
            $path = $value->storeAs($folder_path, $fileName);
            storage_path('app/' . $path);

            $fileId = FileUploadService::addFile($fileName, $value->getClientOriginalName(), $path);

            if ($fileId) {
                BibliographyHasFile::bindBibliographyFile($table_id, $fileId);
            }
        }
    }

    public function get_section(Request $request)
    {
        // dd($request->all());

        $table = DB::table($request->table_name)->get();
        $model_name = $request->table_name;


        return response()->json(['result' => $table, 'model_name' => $model_name,]);
    }
    public function storeTableField($lang, Request $request)
    {


        $newrow = $this->formContentService->store($request->all());

        $table = DB::table($request['table_name'])->get();
        $model_name = $request['table_name'];

        return response()->json(['result' => $table, 'model_name' => $model_name,]);
    }
    public $search = [];
    public function filter(Request $request)
    {
        $model_name = $request->path;

        $query = DB::table($request->path)->where('name', 'like', $request->name . '%')->get();

        foreach ($query as $key => $item) {

            $this->search[$item->id] = $item->name;
        }
        if (count($this->search) === 0) {

            return response()->json(['result' => ''], 400);
        } else {
            return response()->json(['result' => $this->search, 'model_name' => $model_name, 'section_id' => $request->path]);
        }
    }
}
