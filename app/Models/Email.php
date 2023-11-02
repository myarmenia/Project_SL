<?php

namespace App\Models;

use App\Models\Man\Man;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{

    use HasFactory, FilterTrait;

    protected $table = 'email';

    protected $tableFields = ['id', 'address'];

    protected $fillable = [
        'address',
    ];

    public $relation = [];

    public $relationColumn = [
        'id',
        'address'
    ];

    public $modelRelations = ['man', 'organization'];


    public function man() {
        return $this->belongsToMany(Man::class, 'man_has_email');
    }

    public function organization() {
        return $this->belongsToMany(Organization::class, 'organization_has_email');
    }




}
