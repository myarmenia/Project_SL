<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiaSummary extends Model
{
    use HasFactory;

    protected $table = 'mia_summary';

    public function man_count() {
        return $this->belongsToMany(Man::class, 'man_passes_mia_summary')->count();
    }
}
