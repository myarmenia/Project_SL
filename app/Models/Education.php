<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';

    protected $fillable = [
      'name'
    ];

    public function man() {
        return $this->belongsToMany(Man::class, 'man_has_education');
    }

}
