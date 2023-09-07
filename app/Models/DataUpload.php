<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DataUpload extends Model
{
    use HasFactory, Searchable;

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

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
