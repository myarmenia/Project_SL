<?php

namespace App\Models;

use App\Models\Bibliography\Bibliography;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    use HasFactory;
    protected $table = 'access_level';

    protected $fillable = ['name'];

    public function bibliography(){
        return $this->hasMany(Bibliography::class);
    }

}
