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
    protected $guarded=[];

    protected $tableFields = ['id', 'content'];

    protected $manyFilter = ['date'];

    protected $count = ['man_count'];

    public $relation = [
        'man_count1'
    ];

    public $relationColumn = [
        'id',
        'date',
        'content',
        'man_count1'
    ];

    public function man_count1()
    {
        return $this->belongsToMany(Man::class, 'man_passes_mia_summary');
    }
    public function organization(){
        return $this->belongsToMany(Organization::class,'organization_passes_mia_summary');
    }
}
