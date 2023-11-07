<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManExternalSignHasSign extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'man_external_sign_has_sign';

    protected $fillable = [
        'sign_id',
        'fixed_date',
    ];

    protected $tableFields = ['id'];

    protected $manyFilter = ['fixed_date'];

    protected $hasRelationFields = ['sign'];

    public $modelRelations = ['man'];

    public $relation = [
        'sign',
    ];

    public $relationColumn = [
        'id',
        'sign',
        'fixed_date',
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
}
