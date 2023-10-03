<?php

namespace App\Models\TempTables;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpManFindTextsHasMan extends Model
{
    use HasFactory;

    protected $table = 'tmp_man_find_texts_has_men';

    protected $primaryKey = 'tmp_man_find_texts_id';


    public $timestamps = false;

    protected $fillable = [
        'tmp_man_find_texts_id',
        'man_id',
    ];

}
