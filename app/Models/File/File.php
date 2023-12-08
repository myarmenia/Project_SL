<?php

namespace App\Models\File;

use App\Models\Bibliography\Bibliography;
use App\Models\Bibliography\BibliographyHasFile;
use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use PhpOffice\PhpWord\IOFactory;
use Storage;

class File extends Model
{
    use HasFactory, Searchable;

    protected $table = "file";

    protected $fillable = [
        'name',
        'real_name',
        'path',
        'file_comment',
        'via_summary',
        'show_folder',
        'file_lang',
        'file_phonetic'
    ];

    // public static function addFile($fileDetail): int
    // {
    //     info('File sscreate', [(now()->minute * 60) + now()->second]);
    //     $createFile = 21;
    //     // $text = getDocContent(public_path(Storage::url($createFile->path)));
    //     // FileText::create([
    //     //     'file_id'=> $createFile->id,
    //     //     'content'=> $text,
    //     // ]);
    //     info('File sscreate End', [(now()->minute * 60) + now()->second]);

    //     return $createFile;
    // }

    // public function toSearchableArray()
    // {
    //     $text = getDocContent(storage_path('app/' .  $this->path));

    //     return [
    //         'id' => $this->id,
    //         'content' => $text,
    //     ];
    // }


    // // ================
    public function bibliography()
    {
        return $this->belongsToMany(Bibliography::class,'bibliography_has_file');
    }
    //
    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_file');
    }

    public function scopeMiasummary($query, $param)
    {
        return $query->where('via_summary', $param)->get();
    }
}
