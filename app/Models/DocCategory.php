<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocCategory extends Model
{
    use HasFactory;
    protected $table = 'doc_category';

    protected $fillable = ['name'];

    public function bibliography(){
        
        return $this->hasMany(Bibliography::class);

    }
}
