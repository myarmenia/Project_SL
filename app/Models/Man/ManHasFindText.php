<?php

namespace App\Models\Man;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class ManHasFindText extends Model
{
    use HasFactory;

    protected $table = "man_has_find_texts";

    protected $fillable = [
        'man_id',
        'file_id',
        'find_text',
        'paragraph'
    ];

    public $timestamps = false;

    public static function addInfo($findTextDetail): bool
    {
        $newInfo = ManHasFindText::create($findTextDetail);

        return $newInfo !== null;
    }

    public static function getFindTextByFileId($fileId): Collection
    {
        $findTexts = ManHasFindText::where('file_id', $fileId)->get()->pluck('find_text');

        return $findTexts;
    }


}
