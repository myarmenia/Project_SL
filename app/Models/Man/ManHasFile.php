<?php

namespace App\Models\Man;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManHasFile extends Model
{
    use HasFactory;

    protected $table = 'man_has_file';

    protected $fillable = [
        'man_id',
        'file_id'
    ];

    public $timestamps = false;

    public static function bindManFile($manId, $fileId): bool
    {
        $bind = ManHasFile::create([
            'man_id' => $manId,
            'file_id' => $fileId
        ]);

       return  $bind !== null;
    }
}
