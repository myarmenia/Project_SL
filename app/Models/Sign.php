<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'sign';

    protected $fillable = [
        'name',
    ];


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
            // __('content.time_fixation') => $this->man_external_sign_has_sign ?
            //     date('d-m-Y', strtotime($this->man->sign->fixed_date)) : null,

        ];
    }


}
