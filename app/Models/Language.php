<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Language extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'language';

    protected $fillable = [
      'name'
    ];

    public function knows_languages()
    {
        return $this->belongsToMany(Man::class, 'man_knows_language');
    }

}
