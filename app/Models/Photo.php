<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photo';

    protected $fillable = [
      'image'
    ];

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_external_sign_has_photo');
    }

}
