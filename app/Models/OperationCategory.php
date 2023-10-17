<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationCategory extends Model
{
    use HasFactory;

    protected $table = 'operation_category';

    public function man()
    {
        return $this->belongsToMany(Man::class, 'man_has_operation_category');
    }

}
