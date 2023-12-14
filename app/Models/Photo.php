<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'photo';

    protected $fillable = [
      'image'
    ];

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_external_sign_has_photo');
    }

}
