<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sign extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'sign';

    protected $fillable = [
        'name',
    ];

    public $modelRelations = ['man'];


    public function man() {
        return $this->belongsToMany(Man::class, 'man_external_sign_has_sign');
    }

    public function man_external_sign_has_sign() {
        return $this->hasOne(ManExternalSignHasSign::class); //harcnel
        // return $this->hasMany(ManExternalSignHasSign::class);


    }

    public function relation_field()
    {
        return [
            __('content.external_signs') => $this->name ?? null,
            __('content.time_fixation') => null,

        ];
    }


}
