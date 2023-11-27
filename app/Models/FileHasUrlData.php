<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileHasUrlData extends Model
{
    use HasFactory;

    protected $table = 'file_has_url_data';

    protected $fillable = [
        'file_name',
        'url_data',
    ];

}
