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

    public function getFullInfoAttribute(): string  
    {  
        return $this->name." ".$this->surname." ".$this->patronymic." ".$this->birthday;  
    } 


    public function toSearchableArray()
    {
        return [
            "fullInfo" => $this->fullInfo
            // 'id' => $this->id,
            // 'name' => $this->name,
            // 'surname' => $this->surname,
            // 'patronymic' => $this->patronymic,
            // 'birth_year' => $this->birth_year,
            // 'fullName' => $this->name . $this->surname .  $this->patronymic . $this->birth_year .$this -> kdkfkfkfkf

        ];
    }
}
