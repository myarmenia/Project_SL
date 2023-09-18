<?php

namespace App\Models\Man;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManHasBibliography extends Model
{
    use HasFactory;

    protected $table = 'man_has_bibliography';

    protected $fillable = [
        'man_id',
        'bibliography_id',
    ];

    public $timestamps = false;

    public static function bindManBiblography($manId, $bibliographyid): bool
    {
        $result = ManHasBibliography::create([
            'man_id' => $manId,
            'bibliography_id' => $bibliographyid
        ]);

        return $result !== null;
    }


}
