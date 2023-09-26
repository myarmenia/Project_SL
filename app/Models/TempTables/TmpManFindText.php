<?php

namespace App\Models\TempTables;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class TmpManFindText extends Model
{
    use HasFactory;

    protected $table = 'tmp_man_find_texts';


    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'birthday',
        'birth_day',
        'birth_month',
        'birth_year',
        'address',
        'findText',
        'paragraph',
        'file_name',
        'real_file_name',
        'file_path'
    ];

    public function man(): HasMany
    {
        return $this->hasMany(TmpManFindTextsHasMan::class, 'tmp_man_find_texts_id','id');
    }

}
