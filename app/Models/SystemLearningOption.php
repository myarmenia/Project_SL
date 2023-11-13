<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLearningOption extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function learning_system() {
        return $this->belongsTo(LearningSystem::class);
    }
}
