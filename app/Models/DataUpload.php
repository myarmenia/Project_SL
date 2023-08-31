<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUpload extends Model
{
    use HasFactory;

    protected $collactions = 'data_uploads';

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'birthday',
        'address',
        'findText',
        'fileName',
    ];
}
