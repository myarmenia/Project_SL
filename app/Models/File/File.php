<?php

namespace App\Models\File;

use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpWord\IOFactory;
use Laravel\Scout\Searchable;

class File extends Model
{
    use HasFactory, Searchable;

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

    public function getDocContent($file)
    {
        $phpWord = IOFactory::load($file);
        $content = '';
        $sections = $phpWord->getSections();


        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($element->getElements() as $textElement) {
                        if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                            $content .= $textElement->getText() . ' ';
                        }
                    }
                }
            }
        }
        return $content;
    }

    public function toSearchableArray()
    {
        $text = $this->getDocContent(storage_path('app/' .  $this->path));

        return [
            'id' => $this->id,
            'content' => $text,
        ];
    }


    // ================
    public function bibliography()
    {
        return $this->belongsToMany(Bibliography::class);
    }
    //
    public function man()
    {
        return $this->belongsToMany(Man::class,'man_has_file');
    }



}
