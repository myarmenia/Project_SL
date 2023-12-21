<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DocCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'doc_category';

    protected $fillable = ['name'];

    public function bibliography(){

        return $this->hasMany(Bibliography::class);

    }
    public function controll(){

        return $this->hasMany(Controll::class);

    }
}
