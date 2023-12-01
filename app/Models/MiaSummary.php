<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MiaSummary extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'mia_summary';
    protected $guarded=[];

    protected $tableFields = ['id', 'content'];

    protected $manyFilter = ['date'];

    protected $count = ['man_count'];

    public $modelRelations = ['man',  'organization', 'bibliography'];

    public $relation = [
        // 'man_count1'
    ];

    public $relationColumn = [
        'id',
        'date',
        'content',
        // 'man_count1'
    ];

    public function man_count1()
    {
        return $this->belongsToMany(Man::class, 'man_passes_mia_summary');
    }
    public function organization(){
        return $this->belongsToMany(Organization::class,'organization_passes_mia_summary');
    }
    public function bibliography(){
        return $this->belongsTo(Bibliography::class,'bibliography_id');
    }
    public function man(){
        return $this->belongsToMany(Man::class,'man_passes_mia_summary');
    }

    public function relation_field()
    {
        return [
            __('content.date_registration_reports') => $this->date ? date('d-m-Y', strtotime($this->date)) : null,
            __('content.content_inf') => $this->content ?? null,


        ];
    }
}
