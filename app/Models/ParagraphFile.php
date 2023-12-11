<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParagraphFile extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function  man(){
        return $this->belongsTo(Man::class,'man_id');
    }

}
