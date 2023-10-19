<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    use HasFactory;

    protected $table = 'sign';

    protected $fillable = [
        'name',
    ];

    public function man() {
        return $this->belongsToMany(Man::class, 'man_external_sign_has_sign');

    }

    public function man_external_sign_has_sign() {
        return $this->hasOne(ManExternalSignHasSign::class);

    }


}
