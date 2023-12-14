<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Nation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nation';

    protected $fillable = [
          'name'
        ];


    public function man() {
        return $this->hasMany(Man::class);
    }


}
