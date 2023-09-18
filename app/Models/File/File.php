<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = "file";

    protected $fillable = [
        'name',
        'real_name',
        'path',
    ];

    public static function addFile($fileDetail): int
    {
        $createFileId = File::create($fileDetail)->id;

        return $createFileId;
    }

    public static function getFileIdByName($fileName): int
    {
        $id = File::where('name', $fileName)->first()->id;

        return $id;
    }

}
