<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileText extends Model
{
    use HasFactory;

    protected $table = "file_texts";


    protected $guarded = [];

    function file() {
        return $this->belongsTo(File::class, 'file_id');
    }


}

