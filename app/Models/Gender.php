<?php

namespace App\Models;

use App\Models\Man\Man;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $table = 'gender';

    protected $fillable = [
        'name',
    ];

    public function man()
    {
        return $this->hasMany(Man::class);
    }
}
