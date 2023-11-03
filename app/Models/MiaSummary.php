<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiaSummary extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'mia_summary';

    protected $tableFields = ['id', 'content'];

    protected $manyFilter = ['date'];

    public $relation = [
        // 'man_count'
    ];

    public $relationColumn = [
        'id',
        'date',
        'content',
    ];

    public function man_count() {
        return $this->belongsToMany(Man::class, 'man_passes_mia_summary')->count();
    }
}
