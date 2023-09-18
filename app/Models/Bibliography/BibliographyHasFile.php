<?php

namespace App\Models\Bibliography;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibliographyHasFile extends Model
{
    use HasFactory;

    protected $table = "bibliography_has_file";

    protected $fillable = [
        'bibliography_id',
        'file_id'
    ];

    public $timestamps = false;

    public static function bindBibliographyFile($bibliographyId, $fileId): bool
    {
        $result = BibliographyHasFile::create([
            'bibliography_id' => $bibliographyId,
            'file_id' => $fileId
        ]);

        return $result !== null;
    }

    		

}
