<?php

namespace App\Models\TempTables;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

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
        'find_text',
        'paragraph',
        'file_name',
        'real_file_name',
        'file_path',
        'file_id',
        'selected_status',
        'full_name',
        'find_man_id',
        'orginal_name',
        'orginal_surname',
        'orginal_patronymic',
    ];

    public function man(): HasManyThrough
    {
        return $this->hasManyThrough(
            Man::class,
            TmpManFindTextsHasMan::class,
            'tmp_man_find_texts_id',
            'id',
            'id',
            'man_id',
        );
    }

    public function getApprovedMan(): HasOne
    {
        return $this->hasOne(Man::class, 'id', 'find_man_id' );
    }

    public static function getFindTextByFileId($fileId): Collection
    {
        $findTexts = TmpManFindText::where('file_id', $fileId)->get()->pluck('find_text');

        return $findTexts;
    }


    const
        STATUS_AUTOMAT_FOUND = 'automatFound',
        STATUS_MANUALLY_FOUND = 'like',
        STATUS_NEW_ITEM = 'newItemFile';


    public function man_attached_paragraph(){
        return $this->belongsTo(Man::class,'find_man_id');
    }

}
