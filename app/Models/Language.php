<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'language';

    protected $fillable = [
      'name'
    ];

    public function knows_languages()
    {
        return $this->belongsToMany(Man::class, 'man_knows_language');
    }

}
