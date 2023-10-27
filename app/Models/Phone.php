<?php

namespace App\Models;


use App\Models\Man\Man;

use App\Traits\FilterTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'phone';

    protected $fillable = [
        'number',
        'more_data',
    ];

    protected $tableFields = ['number', 'more_data'];
    protected $hasRelationFields = ['character'];


    public function character()
    {
        return $this->belongsToMany(Character::class, 'man_has_phone');
    }

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_phone');
    }

    public function relation_field()
    {
        return [
            'phone_number' => $this->number ?? null,
            'additional_data' => $this->more_data ?? null,

        ];
    }
}
