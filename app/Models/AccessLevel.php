<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AccessLevel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'access_level';

    protected $fillable = ['name'];

    public function bibliography(){
        return $this->hasMany(Bibliography::class);
    }

}
