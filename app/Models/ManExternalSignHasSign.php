<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use App\Traits\HelpersTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManExternalSignHasSign extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;

    protected $table = 'man_external_sign_has_sign';

    protected $fillable = [
        'sign_id',
        'fixed_date',
    ];

    protected $tableFields = ['id'];

    protected $manyFilter = ['fixed_date', 'created_at'];

    protected $hasRelationFields = ['sign'];

    public $modelRelations = ['man'];

    public $relation = [
        'sign',
    ];

    public $relationColumn = [
        'id',
        'sign',
        'fixed_date',
        'created_at'
    ];

    public $timestamps = false;

    public function sign()
    {
        return $this->belongsTo(Sign::class, 'sign_id');
    }

    public function man()
    {
        return $this->belongsTo(Man::class, 'man_id');
    }

    public function setFixedDateAttribute($value): void
    {
        $this->attributes['fixed_date'] = HelpersTraits::getDateTimeFormat($value,true);
    }
}
