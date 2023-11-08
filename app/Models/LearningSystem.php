<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningSystem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function chapter() {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

}
